<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { api, csrf, errorMessage, loadSession, session } from './api';

const router = useRouter();
const open = ref(false);
const logoutError = ref('');
loadSession();

async function logout() {
  logoutError.value = '';
  try {
    await csrf();
    await api.post('/logout');
    session.user = null;
    open.value = false;
    await router.push('/');
  } catch (error) {
    logoutError.value = errorMessage(error);
  }
}
</script>

<template>
  <div class="shell">
    <header class="header">
      <div class="header-inner container">
        <RouterLink class="logo" to="/" @click="open = false">M<span>.</span> <small>MMGRAND</small></RouterLink>
        <button class="menu-toggle" type="button" :aria-expanded="open" aria-controls="navigation" @click="open = !open">{{ open ? 'Закрыть' : 'Меню' }}</button>
        <nav id="navigation" :class="{ open }" aria-label="Основная навигация" @keydown.esc="open = false">
          <RouterLink to="/about" @click="open = false">Обо мне</RouterLink>
          <RouterLink to="/projects" @click="open = false">Проекты</RouterLink>
          <RouterLink to="/posts" @click="open = false">Посты</RouterLink>
          <RouterLink to="/contacts" @click="open = false">Контакты</RouterLink>
          <RouterLink v-if="session.user" class="nav-account" to="/profile" @click="open = false">Профиль</RouterLink>
          <RouterLink v-else-if="session.loaded" class="nav-account" to="/login" @click="open = false">Войти ↗</RouterLink>
          <button v-if="session.user" class="text-button" type="button" @click="logout">Выйти</button>
        </nav>
      </div>
    </header>
    <p v-if="session.error || logoutError" class="container error" role="alert">{{ logoutError || session.error }}</p>
    <main class="main"><RouterView /></main>
    <footer class="footer"><div class="container footer-inner"><span>© {{ new Date().getFullYear() }} MmGrand</span><span>Создано с интересом к деталям.</span><a href="https://github.com/MmGrand" target="_blank" rel="noopener noreferrer">GitHub ↗</a></div></footer>
  </div>
</template>
