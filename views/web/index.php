<?php 
include_once __DIR__ . '/conferencias.php';
?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque" data-aos="fade-up">
            <p class="resumen__texto resumen__texto--numero"><?php echo $ponentes__total ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>
        <div class="resumen__bloque" data-aos="fade-down">
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias__total ?></p>
            <p class="resumen__texto">Conferencias</p>  
        </div>
        <div class="resumen__bloque" data-aos="fade-up">
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops__total ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>
        <div class="resumen__bloque" data-aos="fade-down">
            <p class="resumen__texto resumen__texto--numero">500</p>
            <p class="resumen__texto">Asistentes</p>
        </div> 
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">Conoce a nuestros experto DevWebCamps</p>

    <div class="speakers__grid">
        <?php foreach($ponentes as $ponente): ?>
            <div class="speaker" <?php aos_animation(); ?> >
                <?php
                    $imagePath = htmlspecialchars($_ENV['PROJECT_URL'] . '/img/speakers/' . $ponente->Imagen);
                ?>
                <picture>
                    <source srcset="<?php echo $imagePath; ?>.webp" type="image/webp">
                    <img class="speaker__imagen" src="<?php echo $imagePath; ?>.png" alt="Imagen de Ponente">
                </picture>
                <div class="speaker__informacion">
                    <h4 class="speaker__nombre"><?php echo $ponente->Nombre . " " . $ponente->Apellido ?></h4>
                    <p class="speaker__ubicacion"><?php echo $ponente->Ciudad . ', ' . $ponente->Pais ?></p>

                    <nav class="speaker--sociales">
                        <?php $redes = json_decode($ponente->Redes);?>
                        <?php if(!empty($redes->facebook)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                            <span class="speaker--sociales__ocultar">Facebook</span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(!empty($redes->twitter)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                            <span class="speaker--sociales__ocultar">Twitter</span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(!empty($redes->instagram)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                            <span class="speaker--sociales__ocultar">Instagram</span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(!empty($redes->github)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                            <span class="speaker--sociales__ocultar">Github</span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(!empty($redes->youtube)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                            <span class="speaker--sociales__ocultar">Youtube</span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if(!empty($redes->tiktok)): ?>
                        <a class="speaker--sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                            <span class="speaker--sociales__ocultar">Tiktok</span>
                        </a>
                        <?php endif; ?>
                    </nav>
                    <ul class="speaker__skills">
                        <?php $tags = explode(',',$ponente->Tags); ?>
                        <?php foreach($tags as $tag): ?>
                            <li class="speaker__skills--skill"><?php echo $tag?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div id="mapa" class="mapa"></div> <!-- Creacion del mapa con js -->

<section class="boletos">
    <h2 class="boletos__heading">Boletos & Precios</h2>
    <p class="boletos__descripcion">Precios para DevWebCamp</p>

    <div class="boletos__grid">
        <div class="boleto boleto--presencial">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>
        
        <div class="boleto boleto--virtual">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$49</p>
        </div>
        
        <div class="boleto boleto--gratis">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">Gratis - $0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>