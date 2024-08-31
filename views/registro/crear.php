<main class="registro">
  <h2 class="registro__heading"><?php echo $titulo; ?></h2>
  <p class="registro__descripcion">Elige tu Plan</p>

  <div class="paquetes__grid">
    <div class="paquete">
      <h3 class="paquete__nombre">Pase Gratis</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
      </ul>

      <p class="paquete__precio">S/. 0</p>

      <form action="/finalizar-registro/gratis" method="post">
        <input class="paquetes__submit" type="submit" value="Inscripcion Gratuita">
      </form>
    </div>

    <div class="paquete">
      <h3 class="paquete__nombre">Pase Presencial</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Pase presencial a DevWebCamp</li>
        <li class="paquete__elemento">Pase por 2 Dias</li>
        <li class="paquete__elemento">Acceso a talleres y conferencias</li>
        <li class="paquete__elemento">Acceso a las grabaciones</li>
        <li class="paquete__elemento">Camisa del Evento</li>
        <li class="paquete__elemento">Bebida y Comida</li>
        <li class="paquete__elemento">Bebida y Comida</li>
      </ul>
      <p class="paquete__precio">S/. 199</p>
      <div id="paypal-button-container-presencial"></div>
    </div>

    <div class="paquete">
      <h3 class="paquete__nombre">Pase Virtual</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
        <li class="paquete__elemento">Pase por 2 Dias</li>
        <li class="paquete__elemento">Enlace a talleres y conferencias</li>
        <li class="paquete__elemento">Acceso a las Grabaciones</li>
      </ul>
      <p class="paquete__precio">S/. 49</p>
      <div id="paypal-button-container-virtual"></div>
    </div>
  </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AT7eI8E0GBSw-tRYMm4qjP_mdOw9UksCMWBc4p6Eo12MS7xdVtyc544qM2cxA0RVh7tD1E8MoMDu7QR9"></script>

<script>
  // Configuración del primer botón para el Pase Presencial
  const itemCostPresencial = 199.00;
  const shippingCostPresencial = 0.00;
  const igvPercentage = 0.0; // 18% IGV
  const igvCostPresencial = itemCostPresencial * igvPercentage;
  const totalCostPresencial = (itemCostPresencial + shippingCostPresencial + igvCostPresencial).toFixed(2);

  paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'blue',
      layout: 'vertical',
      label: 'paypal',
    },
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: totalCostPresencial,
            currency_code: 'USD',
            breakdown: {
              item_total: {
                value: itemCostPresencial.toFixed(2),
                currency_code: 'USD'
              },
              shipping: {
                value: shippingCostPresencial.toFixed(2),
                currency_code: 'USD'
              },
              tax_total: {
                value: igvCostPresencial.toFixed(2),
                currency_code: 'USD'
              }
            }
          },
          description: "Pase Presencial a DevWebCamp",
          custom_id: 1
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(async function(details) {
        const datos = new FormData();
        datos.append('Paquete_id', details.purchase_units[0].custom_id);
        datos.append('Pago_id', details.purchase_units[0].payments.captures[0].id);

        try {
          const url = `${location.origin}/finalizar-registro/pagar`;
          const resultado = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const respuesta = await resultado.json();
          if(respuesta.resultado){
            window.location.href = `${location.origin}/finalizar-registro/conferencia`;
          } else {
            console.log('tenemos un error');
          }
        } catch (error) {
          console.log(error);
        }
      });
    },
    onError: function(err) {
      console.error(err);
    }
  }).render('#paypal-button-container-presencial');

  // Configuración del segundo botón para el Pase Virtual
  const itemCostVirtual = 49.00;
  const shippingCostVirtual = 0.00; // Asumiendo que no hay costo de envío para el virtual
  const igvCostVirtual = itemCostVirtual * igvPercentage;
  const totalCostVirtual = (itemCostVirtual + shippingCostVirtual + igvCostVirtual).toFixed(2);

  paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'blue',
      layout: 'vertical',
      label: 'paypal',
    },
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: totalCostVirtual,
            currency_code: 'USD',
            breakdown: {
              item_total: {
                value: itemCostVirtual.toFixed(2),
                currency_code: 'USD'
              },
              shipping: {
                value: shippingCostVirtual.toFixed(2),
                currency_code: 'USD'
              },
              tax_total: {
                value: igvCostVirtual.toFixed(2),
                currency_code: 'USD'
              }
            }
          },
          description: "Pase Virtual a DevWebCamp",
          custom_id: 2
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(async function(details) {
        const datos = new FormData();
        datos.append('Paquete_id', details.purchase_units[0].custom_id);
        datos.append('Pago_id', details.purchase_units[0].payments.captures[0].id);

        try {
          const url = `${location.origin}/finalizar-registro/pagar`;
          const resultado = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const respuesta = await resultado.json();
          if(respuesta.resultado){
            window.location.href = `${location.origin}/finalizar-registro/conferencia`;
          } else {
            console.log('tenemos un error');
          }
        } catch (error) {
          console.log(error);
        }
      });
    },
    onError: function(err) {
      console.error(err);
    }
  }).render('#paypal-button-container-virtual');
</script>
