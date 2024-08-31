function mostrarAlerta(mensaje, tipo, referencia , desaparece = true) {
    const alertaPrevia = document.querySelector(".alerta");
    if (alertaPrevia) {
      alertaPrevia.remove();
    }
    const alerta = document.createElement("DIV");
    alerta.classList.add("alerta", tipo);
    alerta.textContent = mensaje;
    referencia.appendChild(alerta);
    if (desaparece) {
      setTimeout(() => {
          alerta.remove();
        }, 2500);
    }
  }