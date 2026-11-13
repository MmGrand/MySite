import axios from 'axios';
import { reactive } from 'vue';

export const api = axios.create({
  baseURL: '/api',
  headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
  withCredentials: true,
  withXSRFToken: true,
});

export const session = reactive({ user: null, loaded: false, error: '' });

export async function csrf() {
  await axios.get('/sanctum/csrf-cookie', { withCredentials: true });
}

export async function loadSession() {
  try {
    session.user = (await api.get('/user')).data;
    session.error = '';
  } catch (error) {
    if (error.response?.status !== 401) {
      session.error = errorMessage(error);
    }
    session.user = null;
  } finally {
    session.loaded = true;
  }
}

export function errorMessage(error) {
  const errors = error.response?.data?.errors;
  if (errors) return Object.values(errors).flat().join(' ');
  return error.response?.data?.message || 'Не удалось выполнить запрос. Попробуйте ещё раз.';
}

export function safeUrl(url) {
  if (!url) return null;
  try {
    const parsed = new URL(url, window.location.origin);
    return ['http:', 'https:'].includes(parsed.protocol) ? parsed.href : null;
  } catch {
    return null;
  }
}
