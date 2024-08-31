
// document.addEventListener('DOMContentLoaded', function () {
//     loginCrear();
// });

// function loginCrear() {
//     const verPass = document.querySelector('.ver-password2');
// if(verPass){
//     verPassword();
//     verPassword2();
//     validarPasswords();
// }
// }

// function verPassword(){
//     const password = document.querySelector('#Password');
//     const verPass = document.querySelector('.ver-password');
//     verPass.addEventListener('click', function(){
//         if (password.type === "password") {
//             password.type = "text";
//             verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
//             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
//             <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
//             <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
//             <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
//             <path d="M17 21l4 -4" />
//             </svg>`;
//         } else {
//             password.type = "password";
//             verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
//             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
//             <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
//             <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
//             <path d="M19 16l-2 3h4l-2 3" />
//             </svg>`;
//         }
//     })
// }
// function verPassword2(){
//     const password = document.querySelector('#Password2');
//     const verPass = document.querySelector('.ver-password2');
//     verPass.addEventListener('click', function(){
//         if (password.type === "password") {
//             password.type = "text";
//             verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
//             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
//             <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
//             <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
//             <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
//             <path d="M17 21l4 -4" />
//             </svg>`;
//         } else {
//             password.type = "password";
//             verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
//             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
//             <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
//             <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
//             <path d="M19 16l-2 3h4l-2 3" />
//             </svg>`;
//         }
//     })
// }

// function validarPasswords(){
//     const password = document.querySelector('#Password');
//     const password2 = document.querySelector('#Password2');
//     const boton = document.querySelector('.boton');
//     const form = document.querySelector('#crear-cuenta');

//     boton.addEventListener('click' , function(){
//         if (password.value === password2.value) {
//             form.submit();
//         }else{
//             Swal.fire({
//                 icon: "error",
//                 title: "Oops...",
//                 text: "No son iguales las contraseñas",
//                 iconColor : '#007DF4'
//               });
//         }
//     })
// }
import Swal from 'sweetalert2';
(function(){
    const verPass = document.querySelector('.ver-password2');
    if(verPass){
    
    verPassword();
    verPassword2();
    validarPasswords();

    function verPassword(){
    const password = document.querySelector('#Password');
    const verPass = document.querySelector('.ver-password');
    verPass.addEventListener('click', function(){
        if (password.type === "password") {
            password.type = "text";
            verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M17 21l4 -4" />
            </svg>`;
        } else {
            password.type = "password";
            verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 16l-2 3h4l-2 3" />
            </svg>`;
        }
    })
}
function verPassword2(){
    const password = document.querySelector('#Password2');
    const verPass = document.querySelector('.ver-password2');
    verPass.addEventListener('click', function(){
        if (password.type === "password") {
            password.type = "text";
            verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M17 21l4 -4" />
            </svg>`;
        } else {
            password.type = "password";
            verPass.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 16l-2 3h4l-2 3" />
            </svg>`;
        }
    })
}

function validarPasswords(){
    const password = document.querySelector('#Password');
    const password2 = document.querySelector('#Password2');
    const boton = document.querySelector('.boton');
    const form = document.querySelector('#crear-cuenta');

    boton.addEventListener('click' , function(){
        if (password.value === password2.value) {
            form.submit();
        }else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No son iguales las contraseñas",
                iconColor : '#007DF4'
              });
        }
    })
}
    }
})()