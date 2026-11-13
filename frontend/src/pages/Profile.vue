<script setup>
import { ref, watch } from 'vue';
import { api, csrf, errorMessage, safeUrl, session } from '../api';
import Pagination from '../components/Pagination.vue';
const comments = ref(null);
const error = ref('');
const avatarError = ref('');
const success = ref('');
const file = ref(null);
const busy = ref(false);
async function load(page = 1) {
  error.value = '';
  try { comments.value = (await api.get('/profile/comments', { params: { page } })).data; }
  catch (e) { if (e.response?.status === 401) session.user = null; error.value = errorMessage(e); }
}
watch(() => session.user, (user) => { if (user) load(); }, { immediate: true });
async function upload() {
  avatarError.value = ''; success.value = ''; busy.value = true;
  try {
    if (!file.value) { avatarError.value = 'Выберите изображение.'; return; }
    const data = new FormData(); data.append('avatar', file.value);
    await csrf();
    session.user = (await api.post('/profile/avatar', data)).data;
    success.value = 'Аватар обновлён.';
  } catch (e) { if (e.response?.status === 401) session.user = null; avatarError.value = errorMessage(e); }
  finally { busy.value = false; }
}
</script>
<template>
  <div class="container page narrow">
    <p class="eyebrow">ЛИЧНЫЙ КАБИНЕТ</p><h1>Профиль<span>.</span></h1>
    <p v-if="!session.loaded" role="status" class="muted">Загрузка...</p>
    <p v-else-if="!session.user" class="panel">Для просмотра профиля <RouterLink class="inline-link" to="/login">войдите</RouterLink>.</p>
    <template v-else>
      <section class="panel profile"><img :src="safeUrl(session.user.avatar) || '/images/default-avatar.png'" alt="" class="profile-avatar"><div><h2>{{ session.user.name }}</h2><p class="muted">{{ session.user.email }}</p><form class="form" @submit.prevent="upload"><label>Сменить аватар<input type="file" accept="image/jpeg,image/png" required @change="file = $event.target.files[0] || null"></label><p v-if="avatarError" class="error" role="alert">{{ avatarError }}</p><p v-if="success" class="success" role="status">{{ success }}</p><button class="button" :disabled="busy">Обновить</button></form></div></section>
      <section class="section"><h2>Мои комментарии<span>.</span></h2><p v-if="error" class="error" role="alert">{{ error }}</p><p v-else-if="!comments" role="status" class="muted">Загрузка...</p><template v-else><p v-if="!comments.data.length" class="empty">Комментариев пока нет.</p><div v-for="comment in comments.data" :key="comment.id" class="comment"><RouterLink class="inline-link" :to="`/posts/${comment.post.slug}`">{{ comment.post.title }}</RouterLink><p class="comment-content">{{ comment.content }}</p><small>{{ new Date(comment.created_at).toLocaleString('ru-RU') }}</small></div><Pagination :meta="comments.meta" @change="load" /></template></section>
    </template>
  </div>
</template>
