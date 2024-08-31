<main class="pagina">
     <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
     <p class="pagina__descripcion">Tu boleto - Te Recomenamos almacenarlo, puedes compartirlo en tus redes sociales.</p>
     <div class="boleto-virtual">
        <div class="boleto boleto--<?php echo strtolower($registro->Paquete->Nombre); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
                <p class="boleto__plan"><?php echo $registro->Paquete->Nombre; ?></p>
                <p class="boleto__nombre"><?php echo $registro->Usuario->Nombre . " " . $registro->Usuario->Apellido; ?></p>
            </div>

            <p class="boleto__codigo"><?php echo '#' . $registro->Token; ?></p>
        </div>
     </div>
</main>