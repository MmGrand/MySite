import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
	const alerts = document.querySelectorAll('.alert');
	alerts.forEach(alert => {
			setTimeout(() => {
					alert.style.transform = 'translateY(-60px)';
					alert.style.opacity = '0';
					setTimeout(() => alert.remove(), 500);
			}, 3000);
	});

	window.displayFileName = function(input) {
		const fileName = input.files[0] ? input.files[0].name : '';
		const fileNameElement = document.getElementById('file-name-' + input.id);
		if (fileNameElement) {
				fileNameElement.textContent = fileName ? fileName : "{{ __('Нажмите, чтобы выбрать фото') }}";
		}
	};
});