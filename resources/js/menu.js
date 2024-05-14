document.getElementById('menu-btn').addEventListener('click', function() {
	var menu = document.getElementById('menu');
	if (menu.classList.contains('hidden')) {
			menu.classList.remove('hidden');
	} else {
			menu.classList.add('hidden');
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
            scrollBtn.classList.remove('hidden');
            scrollBtn.style.opacity = 1;
        } else {
            scrollBtn.style.opacity = 0;
            setTimeout(() => {
                scrollBtn.classList.add('hidden');
            }, 300);
        }
    }, 100); // Задержка 100 мс

    lastScrollTop = st <= 0 ? 0 : st;
}

window.addEventListener('scroll', handleScroll);

scrollBtn.addEventListener('click', function() {
    window.scrollTo({top: 0, behavior: 'smooth'});
});