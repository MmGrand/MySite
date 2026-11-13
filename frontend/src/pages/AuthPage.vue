<script setup>
import { computed, reactive, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { api, csrf, errorMessage, session } from '../api';
const props = defineProps({ mode: { type: String, required: true } });
const route = useRoute();
const router = useRouter();
const form = reactive({ name: '', email: '', password: '', password_confirmation: '', remember: false, avatar: null });
const error = ref('');
const message = ref('');
const busy = ref(false);
const titles = { login: 'С возвращением', register: 'Создать аккаунт', forgot: 'Забыли пароль?', reset: 'Новый пароль' };
const title = computed(() => titles[props.mode]);
watch(() => props.mode, () => { error.value = ''; message.value = ''; form.password = ''; form.password_confirmation = ''; }, { immediate: true });
async function submit() {
  error.value = ''; message.value = ''; busy.value = true;
  try {
    await csrf();
    let data;
    if (props.mode === 'register') {
      data = new FormData();
      for (const key of ['name', 'email', 'password', 'password_confirmation']) data.append(key, form[key]);
      if (form.avatar) data.append('avatar', form.avatar);
    } else {
      data = { email: form.email, password: form.password, password_confirmation: form.password_confirmation, remember: form.remember };
      if (props.mode === 'reset') data.token = route.params.token;
    }
    const endpoint = { login: 'login', register: 'register', forgot: 'forgot-password', reset: 'reset-password' }[props.mode];
    const response = await api.post(`/${endpoint}`, data);
    if (['login', 'register'].includes(props.mode)) { session.user = response.data; session.error = ''; await router.push('/'); }
    else { message.value = response.data.message; }
  } catch (e) { error.value = errorMessage(e); }
  finally { busy.value = false; }
}
if (props.mode === 'reset' && typeof route.query.email === 'string') form.email = route.query.email;
</script>
<template>
  <div class="container page form-page">
    <p class="eyebrow">АККАУНТ / MMGRAND</p><h1>{{ title }}<span>.</span></h1>
    <p class="lead">{{ mode === 'forgot' ? 'Отправим ссылку для восстановления на вашу почту.' : mode === 'reset' ? 'Введите новый пароль для вашего аккаунта.' : 'Рады видеть вас здесь.' }}</p>
    <form class="panel form" @submit.prevent="submit">
      <label v-if="mode === 'register'">Имя<input v-model="form.name" required maxlength="50" autocomplete="name"></label>
      <label>Электронная почта<input v-model="form.email" type="email" required maxlength="50" autocomplete="email"></label>
      <label v-if="mode !== 'forgot'">Пароль<input v-model="form.password" type="password" required :minlength="mode === 'login' ? undefined : 8" :autocomplete="mode === 'login' ? 'current-password' : 'new-password'"></label>
      <label v-if="mode === 'register' || mode === 'reset'">Повторите пароль<input v-model="form.password_confirmation" type="password" required minlength="8" autocomplete="new-password"></label>
      <label v-if="mode === 'register'">Аватар (необязательно)<input type="file" accept="image/*" @change="form.avatar = $event.target.files[0] || null"></label>
      <label v-if="mode === 'login'" class="checkbox"><input v-model="form.remember" type="checkbox"> Запомнить меня</label>
      <p v-if="error" class="error" role="alert">{{ error }}</p><p v-if="message" class="success" role="status">{{ message }}</p>
      <button class="button" :disabled="busy">{{ busy ? 'Подождите...' : mode === 'login' ? 'Войти' : mode === 'register' ? 'Зарегистрироваться' : mode === 'forgot' ? 'Отправить ссылку' : 'Сохранить пароль' }}</button>
      <div class="form-links"><RouterLink v-if="mode === 'login'" to="/forgot-password">Забыли пароль?</RouterLink><RouterLink v-if="mode === 'login'" to="/register">Создать аккаунт</RouterLink><RouterLink v-else to="/login">Войти в аккаунт</RouterLink></div>
    </form>
  </div>
</template>
