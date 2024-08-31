// let busqueda = {
//     Categoria_id : "",
//     dia : ""
// }

// document.addEventListener('DOMContentLoaded', function () {
//     date();
// });

// function date() {
//     inicializarObjetoEditar();
//     dias();
// }

// async function inicializarObjetoEditar(){//el async para poder ejecutar el await
//     const inputCategoria = document.querySelector('[name="Categoria_id"]');
//     const inputHiddenDias = document.querySelector('[name="Dia_id"]');

//     busqueda = {
//         Categoria_id : +inputCategoria.value || '',
//         dia : +inputHiddenDias.value || ''
//     }

//     if(!Object.values(busqueda).includes('')){
//         await buscarEventos(); // esperamos que se termine de ejecutar el buscarEventos con el await
//     }
//     //para dar estilo y se muestre lo que presionamos
//     const liHora = Array.from(document.querySelectorAll('#horas li'));
//     const inputHora = document.querySelector('[name="Hora_id"]');
//     liHora.forEach((li)=>{
//         if (+li.dataset.horaId === +inputHora.value) {
//             li.classList.add('horas__hora--seleccionado');
//             li.classList.remove('horas__hora--deshabilitado');
//             li.onclick = seleccionarHora;
//         }
//     })
// }

// function dias(){
//     const dias = document.querySelectorAll('[name="dia"]');
//     const categorias = document.querySelector('[name="Categoria_id"]');

//     dias.forEach((dia)=>{
//         dia.addEventListener('change', terminoBusqueda);
//     });
//     categorias.addEventListener('change', terminoBusqueda);

//     function terminoBusqueda(e){
//         busqueda = {...busqueda , [e.target.name]: e.target.value};
//         //console.log(busqueda);
//         const clasePrevia = document.querySelector('.horas__hora--seleccionado');
//         if(clasePrevia){
//         clasePrevia.classList.remove('horas__hora--seleccionado');
//         }

//         const inputHiddenHoras = document.querySelector('[name="Hora_id"]');
//         inputHiddenHoras.value = '';

//         const inputHiddenDias = document.querySelector('[name="Dia_id"]');
//         inputHiddenDias.value = '';

//         if(Object.values(busqueda).includes('')){
//             return;
//         }

//         buscarEventos();
//     }
// }

// async function buscarEventos(){
//     //console.log(busqueda);
//     try {
//         const {Categoria_id, dia} = busqueda;
//         const Url = `${location.origin}/api/eventos-horario?dia_id=${dia}&categoria_id=${Categoria_id}`;

//         const resultado = await fetch(Url);
//         const eventos = await resultado.json();
//         //console.log(eventos);
//         obtenerHorasDisponibles(eventos);
//     } catch (error) {
//         console.log(error);
//     }

// }

// function obtenerHorasDisponibles(events){
//     // Aplana todo el array en un solo nivel para obtener la lista de objetos
//     const eventosAplanados = events.flat(Infinity); // Infinity aplana cualquier nivel de anidamiento

//     const horasTomadas = eventosAplanados.flatMap((evento) => {// Usamos flatMap para obtener todos los 'Hora_id'
//         return Array.isArray(evento.Hora_id) ? evento.Hora_id : [evento.Hora_id];
//     });

//     //console.log('Horas tomadas:', horasTomadas);

//     const listadoHoras = document.querySelectorAll('#horas li');//es un nodeList
//     const listadoHorasArray = Array.from(listadoHoras);//es un array
//     const horashabilitadas = listadoHorasArray.filter(li=> !horasTomadas.includes(li.dataset.horaId));//para tomar los otros que no son
//     //console.log(horashabilitadas);

//     const horasdeshabilitadas = document.querySelectorAll('#horas li');
//     horasdeshabilitadas.forEach((li)=>{
//         li.classList.add('horas__hora--deshabilitado');
//         li.removeEventListener('click', seleccionarHora);//quitar este evento tipo que es una manera muy segura de evitar fallos (ya me fallo XD)
//     })

//     horashabilitadas.forEach((horaHabilitada)=>horaHabilitada.classList.remove('horas__hora--deshabilitado')) ;

//     const btnHoraHabilitadas = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitado)');
//     btnHoraHabilitadas.forEach((horaDisponible)=>{
//         horaDisponible.addEventListener('click',seleccionarHora);
//     });
// }

// function seleccionarHora(e){

//     const inputHiddenHoras = document.querySelector('[name="Hora_id"]');
//     const inputHiddenDias = document.querySelector('[name="Dia_id"]');

//     const clasePrevia = document.querySelector('.horas__hora--seleccionado');
//     if(clasePrevia){
//         clasePrevia.classList.remove('horas__hora--seleccionado');
//     }
//     inputHiddenDias.value = document.querySelector('[name="dia"]:checked').value;
//     inputHiddenHoras.value = e.target.dataset.horaId;

//     e.target.classList.add('horas__hora--seleccionado');
// }

(function () {
  const inputCategoria = document.querySelector('[name="Categoria_id"]');
  if (inputCategoria) {
    let busqueda = {
      Categoria_id: "",
      dia: "",
    };

    dias();
    inicializarObjetoEditar();

    async function inicializarObjetoEditar() {
      //el async para poder ejecutar el await
      const inputCategoria = document.querySelector('[name="Categoria_id"]');
      const inputHiddenDias = document.querySelector('[name="Dia_id"]');

      busqueda = {
        Categoria_id: +inputCategoria.value || "",
        dia: +inputHiddenDias.value || "",
      };

      if (!Object.values(busqueda).includes("")) {
        await buscarEventos(); // esperamos que se termine de ejecutar el buscarEventos con el await
      }
      //para dar estilo y se muestre lo que presionamos
      const liHora = Array.from(document.querySelectorAll("#horas li"));
      const inputHora = document.querySelector('[name="Hora_id"]');
      liHora.forEach((li) => {
        if (+li.dataset.horaId === +inputHora.value) {
          li.classList.add("horas__hora--seleccionado");
          li.classList.remove("horas__hora--deshabilitado");
          li.onclick = seleccionarHora;
        }
      });
    }
    function dias() {
      const dias = document.querySelectorAll('[name="dia"]');
      const categorias = document.querySelector('[name="Categoria_id"]');

      dias.forEach((dia) => {
        dia.addEventListener("change", terminoBusqueda);
      });
      categorias.addEventListener("change", terminoBusqueda);

      function terminoBusqueda(e) {
        busqueda = { ...busqueda, [e.target.name]: e.target.value };
        //console.log(busqueda);
        const clasePrevia = document.querySelector(
          ".horas__hora--seleccionado"
        );
        if (clasePrevia) {
          clasePrevia.classList.remove("horas__hora--seleccionado");
        }

        const inputHiddenHoras = document.querySelector('[name="Hora_id"]');
        inputHiddenHoras.value = "";

        const inputHiddenDias = document.querySelector('[name="Dia_id"]');
        inputHiddenDias.value = "";

        if (Object.values(busqueda).includes("")) {
          return;
        }

        buscarEventos();
      }
    }

    async function buscarEventos() {
      //console.log(busqueda);
      try {
        const { Categoria_id, dia } = busqueda;
        const Url = `${location.origin}/api/eventos-horario?dia_id=${dia}&categoria_id=${Categoria_id}`;

        const resultado = await fetch(Url);
        const eventos = await resultado.json();
        //console.log(eventos);
        obtenerHorasDisponibles(eventos);
      } catch (error) {
        console.log(error);
      }
    }

    function obtenerHorasDisponibles(events) {
      // Aplana todo el array en un solo nivel para obtener la lista de objetos
      const eventosAplanados = events.flat(Infinity); // Infinity aplana cualquier nivel de anidamiento

      const horasTomadas = eventosAplanados.flatMap((evento) => {
        // Usamos flatMap para obtener todos los 'Hora_id'
        return Array.isArray(evento.Hora_id)
          ? evento.Hora_id
          : [evento.Hora_id];
      });

      //console.log('Horas tomadas:', horasTomadas);

      const listadoHoras = document.querySelectorAll("#horas li"); //es un nodeList
      const listadoHorasArray = Array.from(listadoHoras); //es un array
      const horashabilitadas = listadoHorasArray.filter(
        (li) => !horasTomadas.includes(li.dataset.horaId)
      ); //para tomar los otros que no son
      //console.log(horashabilitadas);

      const horasdeshabilitadas = document.querySelectorAll("#horas li");
      horasdeshabilitadas.forEach((li) => {
        li.classList.add("horas__hora--deshabilitado");
        li.removeEventListener("click", seleccionarHora); //quitar este evento tipo que es una manera muy segura de evitar fallos (ya me fallo XD)
      });

      horashabilitadas.forEach((horaHabilitada) =>
        horaHabilitada.classList.remove("horas__hora--deshabilitado")
      );

      const btnHoraHabilitadas = document.querySelectorAll(
        "#horas li:not(.horas__hora--deshabilitado)"
      );
      btnHoraHabilitadas.forEach((horaDisponible) => {
        horaDisponible.addEventListener("click", seleccionarHora);
      });
    }

    function seleccionarHora(e) {
      const inputHiddenHoras = document.querySelector('[name="Hora_id"]');
      const inputHiddenDias = document.querySelector('[name="Dia_id"]');

      const clasePrevia = document.querySelector(".horas__hora--seleccionado");
      if (clasePrevia) {
        clasePrevia.classList.remove("horas__hora--seleccionado");
      }
      inputHiddenDias.value = document.querySelector(
        '[name="dia"]:checked'
      ).value;
      inputHiddenHoras.value = e.target.dataset.horaId;

      e.target.classList.add("horas__hora--seleccionado");
    }
  }
})();
