<script setup>
import { ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { api, errorMessage } from '../api';
import Cards from '../components/Cards.vue';
import Pagination from '../components/Pagination.vue';
const props = defineProps({ type: { type: String, required: true } });
const route = useRoute();
const router = useRouter();
const data = ref(null);
const error = ref('');
const loading = ref(true);
let requestId = 0;
watch(() => [props.type, route.query], async () => {
  const id = ++requestId;
  loading.value = true; error.value = '';
  try { const response = await api.get(`/${props.type}`, { params: route.query }); if (id === requestId) data.value = response.data; }
  catch (e) { if (id === requestId) { data.value = null; error.value = errorMessage(e); } }
  finally { if (id === requestId) loading.value = false; }
}, { immediate: true, deep: true });
function filter(key, value) { const query = { ...route.query, [key]: value || undefined, page: undefined }; router.push({ query }); }
function page(value) { router.push({ query: { ...route.query, page: value } }); }
</script>
<template>
  <div class="container page">
    <p class="eyebrow">{{ type === 'posts' ? 'ЗАМЕТКИ И ИДЕИ' : 'ЧТО Я СОЗДАЮ' }}</p>
    <h1>{{ type === 'posts' ? 'Мои посты' : 'Мои проекты' }}<span>.</span></h1>
    <p class="lead">{{ type === 'posts' ? 'Мысли, находки и опыт разработки.' : 'Избранные работы и эксперименты.' }}</p>
    <div v-if="data" class="filters">
      <label v-if="type === 'posts'">Категория<select :value="route.query.category || ''" @change="filter('category', $event.target.value)"><option value="">Все категории</option><option v-for="item in data.categories" :key="item.slug" :value="item.slug">{{ item.name }}</option></select></label>
      <label>Тег<select :value="route.query.tag || ''" @change="filter('tag', $event.target.value)"><option value="">Все теги</option><option v-for="item in data.tags" :key="item.slug" :value="item.slug">{{ item.name }}</option></select></label>
    </div>
    <p v-if="error" class="error" role="alert">{{ error }}</p><p v-else-if="loading" role="status" class="muted">Загрузка...</p>
    <template v-else-if="data"><Cards :items="data.data" :type="type" /><Pagination :meta="data.meta" @change="page" /></template>
  </div>
</template>
