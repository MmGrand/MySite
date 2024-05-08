document.getElementById('menu-btn').addEventListener('click', function() {
	var menu = document.getElementById('menu');
	if (menu.classList.contains('hidden')) {
			menu.classList.remove('hidden');
	} else {
			menu.classList.add('hidden');
	}
});

let lastScrollTop = 0;
const scrollBtn = document.getElementById('scrollTopBtn');

window.onscroll = function() {
    let st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop) {
        // Прокрутка вниз
        requestAnimationFrame(() => {
            if (st > 340) {
                scrollBtn.classList.remove('hidden');
                scrollBtn.style.opacity = 1;
            } else {
                scrollBtn.style.opacity = 0;
                setTimeout(() => {
                    scrollBtn.classList.add('hidden');
                }, 300);
            }
        });
    } else {
        // Прокрутка вверх
        requestAnimationFrame(() => {
            if (st > 340) {
                scrollBtn.classList.remove('hidden');
                scrollBtn.style.opacity = 1;
            } else {
                scrollBtn.style.opacity = 0;
                setTimeout(() => {
                    scrollBtn.classList.add('hidden');
                }, 300);
            }
        });
    }
    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
};

scrollBtn.addEventListener('click', function() {
    window.scrollTo({top: 0, behavior: 'smooth'});
});