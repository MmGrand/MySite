<script setup>
defineProps({ page: { type: String, required: true } });
</script>
<template>
  <div class="container page">
    <template v-if="page === 'about'">
      <p class="eyebrow">ЗНАКОМСТВО</p><h1>Привет, я Максим<span>.</span></h1>
      <div class="about-grid"><div><p class="lead">Fullstack-разработчик, которому нравится превращать идеи в работающие продукты.</p><p class="muted">Я начал изучать веб-разработку в университете и остановился на PHP и Laravel. Во frontend выбрал Vue.js. С осени 2022 года работаю разработчиком и продолжаю изучать новые возможности.</p><RouterLink class="button" to="/contacts">Связаться со мной ↗</RouterLink></div><img src="/images/main_avatar.jpg" alt="Максим" class="about-photo"></div>
      <section class="section"><p class="eyebrow">ИНСТРУМЕНТЫ</p><h2>Мой стек<span>.</span></h2><div class="skill-grid"><div class="panel"><h3>Frontend</h3><p>HTML, CSS, JavaScript, Vue.js</p></div><div class="panel"><h3>Backend</h3><p>PHP, Laravel</p></div><div class="panel"><h3>Инструменты</h3><p>Docker, Git, MySQL</p></div></div></section>
      <section class="section narrow"><p class="eyebrow">ОПЫТ</p><h2>Разработка на практике<span>.</span></h2><p class="muted">Работаю с PHP и SPA: разрабатываю страницы на Vue.js, маршрутизацию, REST API, интеграции с платёжными системами и функциональность сайтов. Параллельно изучаю Laravel и создаю собственные проекты.</p><div class="actions"><a class="inline-link" href="https://github.com/MmGrand" target="_blank" rel="noopener noreferrer">GitHub ↗</a><a class="inline-link" href="https://hh.ru/resume/e74029faff086439720039ed1f654645784e38" target="_blank" rel="noopener noreferrer">HeadHunter ↗</a></div></section>
    </template>
    <template v-else-if="page === 'contacts'">
      <p class="eyebrow">ОСТАЁМСЯ НА СВЯЗИ</p><h1>Давайте поговорим<span>.</span></h1><p class="lead">Есть идея или вопрос? Напишите мне удобным способом.</p>
      <div class="contact-list"><a href="mailto:maksimzarubin20002000@gmail.com"><span>Почта</span><strong>maksimzarubin20002000@gmail.com</strong><b>↗</b></a><a href="https://t.me/MmGranddd" target="_blank" rel="noopener noreferrer"><span>Telegram</span><strong>@MmGranddd</strong><b>↗</b></a><a href="https://vk.com/maksimzarubin" target="_blank" rel="noopener noreferrer"><span>VK</span><strong>maksimzarubin</strong><b>↗</b></a><a href="tel:+79235641698"><span>Телефон</span><strong>+7 (923) 564-1698</strong><b>↗</b></a></div>
    </template>
    <template v-else><p class="eyebrow">404</p><h1>Страница не найдена<span>.</span></h1><RouterLink class="button" to="/">На главную →</RouterLink></template>
  </div>
</template>
