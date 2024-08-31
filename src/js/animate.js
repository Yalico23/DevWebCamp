import AOS from 'aos';
import 'aos/dist/aos.css';
        AOS.init({
            // Aquí puedes agregar configuraciones adicionales de AOS si es necesario.
            offset: 120, // desplazamiento (en px) desde el punto de activación original
            delay: 0, // valores de 0 a 3000, con un paso de 50ms
            duration: 400, // valores de 0 a 3000, con un paso de 50ms
            easing: 'ease', // easing predeterminado para las animaciones de AOS
            once: false, // si la animación debe ocurrir solo una vez - al desplazarse hacia abajo
            mirror: false, // si los elementos deben animarse al desplazarse más allá de ellos
            anchorPlacement: 'top-bottom', // define qué posición del elemento con respecto a la ventana debe activar la animación
});