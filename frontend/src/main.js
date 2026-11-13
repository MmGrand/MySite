import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import Home from './pages/Home.vue';
import Catalog from './pages/Catalog.vue';
import Post from './pages/Post.vue';
import StaticPage from './pages/StaticPage.vue';
import AuthPage from './pages/AuthPage.vue';
import Profile from './pages/Profile.vue';
import './style.css';

const routes = [
  { path: '/', component: Home, meta: { title: 'Главная' } },
  { path: '/about', component: StaticPage, props: { page: 'about' }, meta: { title: 'Обо мне' } },
  { path: '/contacts', component: StaticPage, props: { page: 'contacts' }, meta: { title: 'Контакты' } },
  { path: '/posts', component: Catalog, props: { type: 'posts' }, meta: { title: 'Посты' } },
  { path: '/projects', component: Catalog, props: { type: 'projects' }, meta: { title: 'Проекты' } },
  { path: '/posts/:slug', component: Post },
  { path: '/login', component: AuthPage, props: { mode: 'login' }, meta: { title: 'Вход' } },
  { path: '/register', component: AuthPage, props: { mode: 'register' }, meta: { title: 'Регистрация' } },
  { path: '/forgot-password', component: AuthPage, props: { mode: 'forgot' }, meta: { title: 'Восстановление пароля' } },
  { path: '/reset-password/:token', component: AuthPage, props: { mode: 'reset' }, meta: { title: 'Новый пароль' } },
  { path: '/profile', component: Profile, meta: { title: 'Профиль' } },
  { path: '/:pathMatch(.*)*', component: StaticPage, props: { page: 'notFound' }, meta: { title: 'Страница не найдена' } },
];

const router = createRouter({ history: createWebHistory(), routes, scrollBehavior: () => ({ top: 0 }) });
router.afterEach((to) => { document.title = `${to.meta.title || 'Пост'} — MmGrand`; });
createApp(App).use(router).mount('#app');
