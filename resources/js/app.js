import './bootstrap';
import 'flowbite';

import Swiper from 'swiper/bundle';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Inisialisasi AOS setelah DOM ready
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out-cubic',
        once: true,
        offset: 100,
        disable: false
    });
});

// Refresh AOS jika ada perubahan dinamis
window.addEventListener('load', () => {
    AOS.refresh();
});

AOS.init(); // Initialize AOS