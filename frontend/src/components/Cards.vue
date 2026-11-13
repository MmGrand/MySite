<script setup>
import { safeUrl } from '../api';
defineProps({ items: { type: Array, required: true }, type: { type: String, required: true } });
</script>

<template>
  <div v-if="items.length" class="cards">
    <article v-for="item in items" :key="item.id" class="card">
      <RouterLink v-if="type === 'posts'" :to="`/posts/${item.slug}`" class="card-link">
        <img v-if="safeUrl(item.preview_image)" :src="safeUrl(item.preview_image)" :alt="item.title" class="card-image">
        <div v-else class="card-placeholder">M.</div>
        <div class="card-body"><div class="card-top"><span>{{ item.category?.name || 'Пост' }}</span><span>↗</span></div><h3>{{ item.title }}</h3><p>{{ item.preview_content }}</p><div class="tags"><span v-for="tag in item.tags" :key="tag.slug">{{ tag.name }}</span></div><small>{{ item.views_count }} просмотров</small></div>
      </RouterLink>
      <a v-else-if="safeUrl(item.url)" :href="safeUrl(item.url)" target="_blank" rel="noopener noreferrer" class="card-link">
        <img v-if="safeUrl(item.preview_image)" :src="safeUrl(item.preview_image)" :alt="item.title" class="card-image">
        <div v-else class="card-placeholder">M.</div>
        <div class="card-body"><div class="card-top"><span>Проект</span><span>↗</span></div><h3>{{ item.title }}</h3><p>{{ item.preview_content }}</p><div class="tags"><span v-for="tag in item.tags" :key="tag.slug">{{ tag.name }}</span></div></div>
      </a>
      <div v-else class="card-body"><h3>{{ item.title }}</h3><p>{{ item.preview_content }}</p><p class="error">Некорректная ссылка на проект.</p></div>
    </article>
  </div>
  <p v-else class="empty">Ничего не найдено.</p>
</template>
