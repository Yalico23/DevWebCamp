<div class="evento  swiper-slide">
    <p class="evento__hora"><?php echo $evento->Hora->Hora ?></p>
    <div class="evento__informacion">

        <h4 class="evento__nombre"><?php echo $evento->Nombre ?></h4>

        <div>
            <p class="evento__introduccion"><?php echo $evento->Descripcion; ?></p>
        </div>

        <div class="evento__autor--info">
            <?php
            $imagePath = htmlspecialchars($_ENV['PROJECT_URL'] . '/img/speakers/' . $evento->Ponente->Imagen);
            ?>
            <picture>
                <source srcset="<?php echo $imagePath; ?>.webp" type="image/webp">
                <img class="evento__imagen-autor" src="<?php echo $imagePath; ?>.png" alt="Imagen de Ponente">
            </picture>
            <p class="evento__autor-nombre">
                <?php echo $evento->Ponente->Nombre . " " . $evento->Ponente->Apellido; ?>
            </p>
        </div>

    </div>
</div>