<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    private function storeAvatar(UploadedFile $file): string
    {
        $path = $file->store('avatars', 'public');
        if ($path === false) {
            throw new \RuntimeException('Failed to store avatar.');
        }

        return $path;
    }

    private function userData(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ? Storage::url($user->avatar) : null,
        ];
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $request->hasFile('avatar') ? $this->storeAvatar($request->file('avatar')) : null,
        ]);
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json($this->userData($user), 201);
    }

    public function login(Request $request): array
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required|string']);
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages(['email' => ['Неверный email или пароль.']]);
        }
        $request->session()->regenerate();

        return $this->userData($request->user());
    }

    public function user(Request $request): array
    {
        return $this->userData($request->user());
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function avatar(Request $request): array
    {
        $request->validate(['avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
        $user = $request->user();
        $user->avatar = $this->storeAvatar($request->file('avatar'));
        $user->save();

        return $this->userData($user);
    }

    public function comments(Request $request)
    {
        $comments = $request->user()->comments()->whereHas('post', fn ($query) => $query->where('is_published', true))
            ->with('post:id,title,slug')->paginate(20);

        return [
            'data' => $comments->getCollection()->map(fn ($comment) => [
                'id' => $comment->id,
                'content' => $comment->content,
                'created_at' => $comment->created_at,
                'post' => $comment->post->only('title', 'slug'),
            ]),
            'meta' => ['current_page' => $comments->currentPage(), 'last_page' => $comments->lastPage()],
        ];
    }

    public function storeComment(Request $request, ContentController $content)
    {
        $data = $request->validate([
            'post_id' => ['required', Rule::exists('posts', 'id')->where('is_published', true)],
            'content' => 'required|string|max:255',
            'parent_id' => ['nullable', Rule::exists('comments', 'id')->where('post_id', $request->input('post_id'))->whereNull('parent_id')],
        ]);
        $comment = Comment::create([
            'post_id' => $data['post_id'],
            'content' => $data['content'],
            'parent_id' => $data['parent_id'] ?? null,
            'author_id' => $request->user()->id,
        ]);
        $comment->load('author');

        return response()->json($content->commentData($comment), 201);
    }

    public function forgotPassword(Request $request): array
    {
        $data = $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($data);
        if (!in_array($status, [Password::RESET_LINK_SENT, Password::INVALID_USER], true)) {
            throw ValidationException::withMessages(['email' => [__($status)]]);
        }

        return ['message' => 'Если аккаунт существует, ссылка для восстановления отправлена на почту.'];
    }

    public function resetPassword(Request $request): array
    {
        $data = $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $status = Password::reset($data, function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password), 'remember_token' => Str::random(60)])->save();
            event(new PasswordReset($user));
        });
        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['email' => [__($status)]]);
        }

        return ['message' => 'Пароль изменён. Теперь вы можете войти.'];
    }
}
