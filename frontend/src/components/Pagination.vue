<script setup>
defineProps({ meta: { type: Object, required: true } });
defineEmits(['change']);
</script>
<template>
  <nav v-if="meta.last_page > 1" class="pagination" aria-label="Страницы">
    <button type="button" :disabled="meta.current_page <= 1" @click="$emit('change', meta.current_page - 1)">← Назад</button>
    <span>{{ meta.current_page }} / {{ meta.last_page }}</span>
    <button type="button" :disabled="meta.current_page >= meta.last_page" @click="$emit('change', meta.current_page + 1)">Далее →</button>
  </nav>
</template>
