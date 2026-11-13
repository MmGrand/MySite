<script setup>
import { onMounted, ref } from 'vue';
import { api, errorMessage } from '../api';
import Cards from '../components/Cards.vue';
const data = ref(null);
const error = ref('');
onMounted(async () => { try { data.value = (await api.get('/home')).data; } catch (e) { error.value = errorMessage(e); } });
</script>
<template>
  <div class="container">
    <section class="hero"><p class="eyebrow"><span class="dot"></span> ПОРТФОЛИО · FULLSTACK РАЗРАБОТЧИК</p><h1>Идеи становятся<br><em>цифровым опытом.</em></h1><p class="lead">Привет, я Максим. Создаю сайты и приложения, делюсь проектами и заметками о разработке.</p><div class="actions"><RouterLink to="/projects" class="button">Смотреть проекты ↗</RouterLink><RouterLink to="/about" class="inline-link">Немного обо мне →</RouterLink></div><div class="hero-mark" aria-hidden="true">M<span>.</span></div></section>
    <p v-if="error" class="error" role="alert">{{ error }}</p><p v-else-if="!data" class="muted" role="status">Загрузка...</p>
    <template v-else>
      <section class="section"><div class="section-heading"><div><p class="eyebrow">01 / ИЗБРАННОЕ</p><h2>Мои проекты<span>.</span></h2></div><RouterLink class="inline-link" to="/projects">Все проекты →</RouterLink></div><Cards :items="data.projects" type="projects" /></section>
      <section class="section"><div class="section-heading"><div><p class="eyebrow">02 / ЗАМЕТКИ И ИДЕИ</p><h2>Последние посты<span>.</span></h2></div><RouterLink class="inline-link" to="/posts">Все посты →</RouterLink></div><Cards :items="data.posts" type="posts" /></section>
    </template>
  </div>
</template>
