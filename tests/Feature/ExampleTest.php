<?php

namespace Tests\Feature;

use App\MoonShine\Resources\PostResource;
use App\MoonShine\Pages\Dashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_page_loads_assets_from_the_production_manifest(): void
    {
        $directory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mysite-vite-' . bin2hex(random_bytes(8));
        $originalPublicPath = $this->app->publicPath();
        mkdir($directory . DIRECTORY_SEPARATOR . 'build', 0777, true);

        try {
            file_put_contents($directory . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'manifest.json', json_encode([
                'resources/js/app.js' => [
                    'file' => 'assets/app.js',
                    'src' => 'resources/js/app.js',
                    'isEntry' => true,
                    'css' => ['assets/app.css'],
                ],
            ], JSON_THROW_ON_ERROR));
            $this->app->usePublicPath($directory);
            Vite::useHotFile($directory . DIRECTORY_SEPARATOR . 'hot');

            $this->get('/')
                ->assertOk()
                ->assertSee('build/assets/app.js')
                ->assertSee('build/assets/app.css');
        } finally {
            $this->app->usePublicPath($originalPublicPath);
            unlink($directory . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'manifest.json');
            rmdir($directory . DIRECTORY_SEPARATOR . 'build');
            rmdir($directory);
        }
    }

    public function test_the_moonshine_login_page_is_available(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_moonshine_post_form_keeps_its_validation_rules(): void
    {
        $postResource = app(CoreContract::class)
            ->getResources()
            ->findByClass(PostResource::class);

        $this->assertInstanceOf(PostResource::class, $postResource);
        $postResource->getFormFields();

        $formPage = $postResource->getFormPage();

        $this->assertNotNull($formPage);
        $this->assertSame('required|string|max:50', $formPage->getRules()['title']);
    }

    public function test_moonshine_dashboard_builds_its_components(): void
    {
        $dashboard = app(CoreContract::class)
            ->getPages()
            ->findByClass(Dashboard::class);

        $this->assertInstanceOf(Dashboard::class, $dashboard);
        $this->assertNotEmpty($dashboard->getComponents());
    }
}
