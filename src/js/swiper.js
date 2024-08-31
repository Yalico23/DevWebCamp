import Swiper from "swiper";
import 'swiper/css';
import {Navigation, Pagination, Autoplay  } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

Swiper.use([Navigation, Pagination, Autoplay ]);

(function() {
    const slider = document.querySelector('.slider');
    if (slider) {
        const opciones = {
            slidesPerView : 1,
            spaceBetween: 15,
            loop: false,
            autoplay: {
                delay: 3000, // Cambia a la siguiente diapositiva cada 3 segundos
                disableOnInteraction: false, // No desactiva el autoplay en la interacción del usuario
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints:{
                760:{
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        };

        new Swiper('.slider', opciones);
    }
})();
