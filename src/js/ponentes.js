(function () {
  const inputPonentesBuscar = document.querySelector("#Ponentes");
  if (inputPonentesBuscar) {
    let ponentes = [];

    EditarPonente(); //editar.php carga
    ApiPonenetes();
    buscarPonente();

    function EditarPonente() {
      const inputPonente = document.querySelector('[name="Ponente_id"]');
      if (inputPonente.value) {
        buscarPonenteId(+inputPonente.value);
      }
    }

    async function buscarPonenteId(Id) {
      const URL = `${location.origin}/api/ponente?Id=${Id}`;
      const respuesta = await fetch(URL);
      const resultado = await respuesta.json();
      cargarInput(resultado);
    }

    function cargarInput(json) {
      const listadoPonente = document.querySelector("#ulPonente");
      const liPonente = document.createElement("LI");
      const { Nombre, Apellido } = json;
      liPonente.classList.add(
        "listado-ponentes__ponente",
        "listado-ponentes__ponente--seleccionado"
      );
      liPonente.textContent = `${Nombre} ${Apellido}`;
      listadoPonente.appendChild(liPonente);
    }

    async function ApiPonenetes() {
      const url = `${location.origin}/api/ponentes`;

      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      formatearJson(resultado);
    }

    function formatearJson(ponentesjson) {
      ponentes = ponentesjson.map((json) => {
        return {
          Nombre: `${json.Nombre.trim()} ${json.Apellido.trim()}`,
          Id: json.Id,
        };
      });
    }

    function buscarPonente() {
      const inputPonentesBuscar = document.querySelector("#Ponentes");
      inputPonentesBuscar.addEventListener("input", EventoBuscar);
    }

    function EventoBuscar(e) {
      let ponentesFiltrados = []; //
      const busqueda = e.target.value.replace(/\s+/g, ""); //eliminar los espacion porque si no muestra todos los ponentes

      if (busqueda.length > 0) {
        const expresion = new RegExp(busqueda, "i"); //expresion regular , buscar un patron
        ponentesFiltrados = ponentes.filter((ponente) => {
          if (ponente.Nombre.toLowerCase().search(expresion) != -1) {
            return ponente;
          }
        });
      } else {
        ponentesFiltrados = [];
      }
      mostrarPonente(ponentesFiltrados);
    }

    function mostrarPonente(ponentesFiltrados) {
      const ulPonentes = document.querySelector("#ulPonente");

      while (ulPonentes.firstChild) {
        ulPonentes.removeChild(ulPonentes.firstChild);
      }

      if (ponentesFiltrados.length > 0) {
        ponentesFiltrados.forEach((ponente) => {
          const ponenteHtml = document.createElement("LI");
          ponenteHtml.classList.add("listado-ponentes__ponente");
          ponenteHtml.textContent = ponente.Nombre;
          ponenteHtml.dataset.IdPonente = ponente.Id;
          ponenteHtml.onclick = ponenteSeleccioando;

          ulPonentes.appendChild(ponenteHtml);
        });
      } else {
        mostrarAlerta("No se encontro Ponentes", "error", ulPonentes);
      }
    }

    function ponenteSeleccioando(e) {
      const inputPonente = document.querySelector('[name = "Ponente_id"]');
      const previoSeleccionado = document.querySelector(
        ".listado-ponentes__ponente--seleccionado"
      );
      if (previoSeleccionado)
        previoSeleccionado.classList.remove(
          "listado-ponentes__ponente--seleccionado"
        );

      e.target.classList.add("listado-ponentes__ponente--seleccionado");
      inputPonente.value = e.target.dataset.IdPonente;
    }

    function mostrarAlerta(mensaje, tipo, referencia, desaparece = true) {
      const alertaPrevia = document.querySelector(".alerta");
      if (alertaPrevia) {
        alertaPrevia.remove();
      }
      const alerta = document.createElement("DIV");
      alerta.classList.add("alerta");
      alerta.classList.add(`alerta__${tipo}`);
      alerta.textContent = mensaje;
      referencia.appendChild(alerta);
      if (desaparece) {
        setTimeout(() => {
          alerta.remove();
        }, 2500);
      }
    }
  }
})();
