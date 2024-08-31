import Swal from 'sweetalert2'

(function () {
  const resumen = document.querySelector("#registro-resumen");

  if (resumen) {
    let eventos = [];
    const eventosBoton = document.querySelectorAll(".evento__agregar");
    const formularioRegistro = document.querySelector("#registro");
    formularioRegistro.addEventListener("click", submitRegistro);

    eventosBoton.forEach((boton) => {
      boton.addEventListener("click", seleccionarEvento);
    });

    function seleccionarEvento(e) {
      //   console.log(e.target.dataset.id);
      //   console.log(
      //     e.target.parentElement
      //       .querySelector(".evento__nombre")
      //       .textContent.trim()
      //   );

      if (eventos.length < 5) {
        eventos = [
          ...eventos,
          {
            Id: e.target.dataset.id,
            titulo: e.target.parentElement
              .querySelector(".evento__nombre")
              .textContent.trim(),
          },
        ];
        //console.log(eventos);
        e.target.disabled = true;
        mostrarEventos();
      } else {
        mostrarAlerta(
          "Solo puedes seleccionar 5 eventos",
          "error",
          "#registro-resumen"
        );
      }
    }

    function mostrarEventos() {
      if (eventos.length >= 0) {
        limpiarResumen();
        eventos.forEach((evento) => {
          const eventoDom = document.createElement("DIV");
          eventoDom.classList.add("registro__evento");

          const titulo = document.createElement("H3");
          titulo.classList.add("registro__nombre");
          titulo.textContent = evento.titulo;

          const btnEliminar = document.createElement("BUTTON");
          btnEliminar.classList.add("registro__eliminar");
          btnEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
          btnEliminar.onclick = function () {
            eliminarEvento(evento.Id);
          };

          eventoDom.appendChild(titulo);
          eventoDom.appendChild(btnEliminar);
          resumen.appendChild(eventoDom);
        });
      }
    }

    function limpiarResumen() {
      while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
      }
    }

    function eliminarEvento(id) {
      eventos = eventos.filter((evento) => evento.Id !== id);
      const botonAgregar = document.querySelector(`[data-id="${id}"]`);
      botonAgregar.disabled = false;
      mostrarEventos();
    }

    async function submitRegistro(e) {
      e.preventDefault();
      const regaloId = document.querySelector("#regalo").value;
      const eventosId = eventos.map((evento) => evento.Id);

      if (eventos.length === 0 || regaloId === "") {
        mostrarAlerta(
          "Debes seleccionar al menos 1 evento y 1 regalo",
          "error",
          "#registro-resumen"
        );
        return;
      }
      //api
      //console.log(eventosId);
      try {
        const url = `${location.origin}/finalizar-registro/registro`;

        const datos = new FormData();
        datos.append("eventos", eventosId);
        datos.append("regalo_id", regaloId);

        const respuesta = await fetch(url, {
          method: "POST",
          body: datos,
        });

        const resultado = await respuesta.json();

        if (resultado.resultado) {
          Swal.fire({
            title: "Registro Exitoso",
            text: "Tus conferencias se han almacenado y tu registro fue exitoso, te esperamos en DevWebCamp",
            icon: "success",
          }).then( ()=> location.href = `/boleto?Id=${resultado.token}` )
        } else {
          Swal.fire({
            icon: "Error",
            title: "Hubo un error",
            confirmButtonText: "OK",
          }).then( () => location.reload() );
        }
      } catch (error) {
        console.log(error);
      }
    }

    function mostrarAlerta(mensaje, tipo, referencia, desaparece = true) {
      const alertaPrevia = document.querySelector(".alerta");
      if (alertaPrevia) {
        alertaPrevia.remove();
      }
      const alerta = document.createElement("DIV");
      alerta.classList.add("alerta", `alerta__${tipo}`);
      alerta.textContent = mensaje;
      const Elementoreferencia = document.querySelector(referencia);
      Elementoreferencia.appendChild(alerta);
      if (desaparece) {
        setTimeout(() => {
          alerta.remove();
        }, 2500);
      }
    }
  }
})();
