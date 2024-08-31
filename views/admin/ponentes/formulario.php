<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="Nombre">Nombre</label>
        <input 
        type="text"
        class="formulario__input"
        id="Nombre"
        name="Nombre"
        placeholder="Nombre Ponente"
        value="<?php echo $ponente->Nombre ?? ''?>"
        >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="Apellido">Apellido</label>
        <input 
        type="text"
        class="formulario__input"
        id="Apellido"
        name="Apellido"
        placeholder="Apellido Ponente"
        value="<?php echo $ponente->Apellido ?? ''?>"
        >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="Ciudad">Ciudad</label>
        <input 
        type="text"
        class="formulario__input"
        id="Ciudad"
        name="Ciudad"
        placeholder="Ciudad Ponente"
        value="<?php echo $ponente->Ciudad ?? ''?>"
        >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="Pais">Pais</label>
        <input 
        type="text"
        class="formulario__input"
        id="Pais"
        name="Pais"
        placeholder="Pais Ponente"
        value="<?php echo $ponente->Pais ?? ''?>"
        >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="Imagen">Imagen</label>
        <input 
        type="file"
        class="formulario__input formulario__input--file"
        id="Imagen"
        name="Imagen"
        accept="image/*"
        >
    </div>
    <?php if(isset($imagen_actual)): ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <?php
                $imagePath = htmlspecialchars($_ENV['PROJECT_URL'].'/img/speakers/'.$ponente->Imagen);
            ?>
            <picture>
                <source srcset="<?php echo $imagePath; ?>.webp" type="image/webp">
                <img src="<?php echo $imagePath; ?>.png" alt="Imagen de Ponente">
            </picture>
        </div>
    <?php endif; ?>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="tags_input">Areas de Experiencia (separados por coma)</label>
        <input 
        type="text"
        class="formulario__input"
        id="tags_input"
        placeholder="Ej. Node.js, PHP, CSS, Laravel, UX/UI"
        >
        
        <div id="tags" class="formulario__listado"></div>

        <input 
        type="hidden" 
        name="Tags" 
        value="<?php echo $ponente->Tags ?? '';  ?>">
    </div>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-facebook"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[facebook]"
        placeholder="Facebook"
        value="<?php echo $redes->facebook ?? ''?>"
        >
    </div>
    
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-twitter"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[twitter]"
        placeholder="Twitter"
        value="<?php echo $redes->twitter ?? ''?>"
        >
    </div>
    
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-instagram"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[instagram]"
        placeholder="Instagram"
        value="<?php echo $redes->instagram ?? ''?>"
        >
    </div>
    
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-github"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[github]"
        placeholder="Github"
        value="<?php echo $redes->github ?? ''?>"
        >
    </div>
    
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-youtube"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[youtube]"
        placeholder="Youtube"
        value="<?php echo $redes->youtube ?? ''?>"
        >
    </div>
    
    <div class="formulario__contenedor--icono">
        <div class="formulario__icono">
            <i class="fa-brands fa-tiktok"></i>
        </div>
        <input 
        type="text"
        class="formulario__input formulario__input--sociales"
        name="Redes[tiktok]"
        placeholder="Tiktok"
        value="<?php echo $redes->tiktok ?? ''?>"
        >
    </div>
</fieldset>