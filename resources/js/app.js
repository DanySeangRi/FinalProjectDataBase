import '../css/app.css';

window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-lucide]').forEach((element) => {
        if (typeof window.lucide !== 'undefined') {
            window.lucide.createIcons();
        }
    });
});
