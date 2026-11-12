const menuButton = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (menuButton && mobileMenu) {
    function setMenuOpen(isOpen) {
        menuButton.setAttribute('aria-expanded', String(isOpen));
        menuButton.setAttribute('aria-label', isOpen ? menuButton.dataset.closeLabel : menuButton.dataset.openLabel);
        mobileMenu.setAttribute('aria-hidden', String(!isOpen));
        mobileMenu.toggleAttribute('inert', !isOpen);
        mobileMenu.classList.toggle('-translate-y-full', !isOpen);
        mobileMenu.classList.toggle('translate-y-0', isOpen);
    }

    menuButton.addEventListener('click', function () {
        setMenuOpen(menuButton.getAttribute('aria-expanded') !== 'true');
    });

    mobileMenu.addEventListener('click', function (event) {
        if (event.target.closest('a')) {
            setMenuOpen(false);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
            setMenuOpen(false);
            menuButton.focus();
        }
    });
}

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