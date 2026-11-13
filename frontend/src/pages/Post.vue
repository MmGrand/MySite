<script setup>
import { computed, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import DOMPurify from 'dompurify';
import { api, csrf, errorMessage, safeUrl, session } from '../api';

const route = useRoute();
const post = ref(null);
const error = ref('');
const formError = ref('');
const content = ref('');
const parentId = ref(null);
const sending = ref(false);
const sanitized = computed(() => DOMPurify.sanitize(post.value?.main_content || '', { USE_PROFILES: { html: true } }));
let requestId = 0;
watch(() => route.params.slug, async (slug) => {
  const id = ++requestId;
  post.value = null; error.value = ''; formError.value = ''; content.value = ''; parentId.value = null;
  try {
    const response = await api.get(`/posts/${encodeURIComponent(slug)}`);
    if (id === requestId) { post.value = response.data; document.title = `${response.data.title} — MmGrand`; }
  } catch (e) { if (id === requestId) error.value = errorMessage(e); }
}, { immediate: true });

async function submit() {
  formError.value = ''; sending.value = true;
  try {
    await csrf();
    const { data } = await api.post('/comments', { post_id: post.value.id, parent_id: parentId.value, content: content.value });
    if (parentId.value) {
      const parent = post.value.comments.find((item) => item.id === parentId.value);
      if (parent) parent.children.push(data);
    } else {
      post.value.comments.unshift({ ...data, children: [] });
    }
    content.value = ''; parentId.value = null;
  } catch (e) {
    if (e.response?.status === 401) session.user = null;
    formError.value = errorMessage(e);
  } finally { sending.value = false; }
}
function date(value) { return new Date(value).toLocaleString('ru-RU'); }
</script>
<template>
  <div class="container page narrow">
    <RouterLink class="inline-link" to="/posts">← Все посты</RouterLink>
    <p v-if="error" class="error" role="alert">{{ error }}</p><p v-else-if="!post" class="muted" role="status">Загрузка...</p>
    <template v-else>
      <article><p class="eyebrow article-eyebrow">{{ post.category?.name || 'ПОСТ' }} · {{ post.views_count }} ПРОСМОТРОВ</p><h1>{{ post.title }}</h1><div class="tags"><span v-for="tag in post.tags" :key="tag.slug">{{ tag.name }}</span></div><img v-if="safeUrl(post.main_image)" :src="safeUrl(post.main_image)" :alt="post.title" class="article-image"><div class="prose" v-html="sanitized"></div></article>
      <section class="section comments"><div class="section-heading"><div><p class="eyebrow">ОБСУЖДЕНИЕ</p><h2>Комментарии<span>.</span></h2></div></div>
        <form v-if="session.user" class="panel comment-form" @submit.prevent="submit">
          <label for="comment">{{ parentId ? 'Ответ на комментарий' : 'Ваш комментарий' }}</label>
          <textarea id="comment" v-model="content" required maxlength="255" rows="3"></textarea>
          <p v-if="formError" class="error" role="alert">{{ formError }}</p>
          <div class="actions"><button class="button" :disabled="sending">{{ sending ? 'Отправка...' : 'Отправить' }}</button><button v-if="parentId" class="text-button" type="button" @click="parentId = null">Отменить ответ</button></div>
        </form>
        <p v-else class="panel">Чтобы оставить комментарий, <RouterLink class="inline-link" to="/login">войдите</RouterLink>.</p>
        <p v-if="!post.comments.length" class="empty">Пока нет комментариев. Будьте первым!</p>
        <div v-for="comment in post.comments" :key="comment.id" class="comment">
          <div class="comment-author"><img :src="safeUrl(comment.author.avatar) || '/images/default-avatar.png'" alt="" class="avatar"><div><strong>{{ comment.author.name }}</strong><small>{{ date(comment.created_at) }}</small></div></div>
          <p class="comment-content">{{ comment.content }}</p>
          <button v-if="session.user" class="text-button" type="button" @click="parentId = comment.id; content = ''; formError = ''">Ответить ↗</button>
          <div v-for="child in comment.children" :key="child.id" class="comment reply"><div class="comment-author"><img :src="safeUrl(child.author.avatar) || '/images/default-avatar.png'" alt="" class="avatar"><div><strong>{{ child.author.name }}</strong><small>{{ date(child.created_at) }}</small></div></div><p class="comment-content">{{ child.content }}</p></div>
        </div>
      </section>
    </template>
  </div>
</template>
