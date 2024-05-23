document.getElementById('menu-btn').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    if (menu.classList.contains('-translate-y-full')) {
        menu.classList.remove('-translate-y-full');
        menu.classList.add('translate-y-0');
    } else {
        menu.classList.remove('translate-y-0');
        menu.classList.add('-translate-y-full');
    }
});

let lastScrollTop = 0;
let timeout;

const scrollBtn = document.getElementById('scrollTopBtn');

function handleScroll() {
    let st = window.pageYOffset || document.documentElement.scrollTop;

    // Очистить предыдущий таймаут
    if (timeout) {
        clearTimeout(timeout);
    }

    // Debounce настройка
    timeout = setTimeout(() => {
        if (st > 340) {
            if (scrollBtn.classList.contains('hidden')) {
                scrollBtn.classList.remove('hidden');
                setTimeout(() => {
                    scrollBtn.style.opacity = 1;
                }, 20); // Небольшая задержка для корректного срабатывания CSS перехода
            }
        } else {
            scrollBtn.style.opacity = 0;
            setTimeout(() => {
                if (scrollBtn.style.opacity == 0) {
                    scrollBtn.classList.add('hidden');
                }
            }, 300); // Продолжительность должна соответствовать 'duration-300'
        }
    }, 100); // Задержка 100 мс

    lastScrollTop = st <= 0 ? 0 : st;
}

window.addEventListener('scroll', handleScroll);

scrollBtn.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});