<h2 class="pagina__heading"><?php echo $titulo ?></h2>
<p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
        <p class="eventos-registro__fecha">Lunes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach ($eventos['conferencias_L'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Martes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach ($eventos['conferencias_M'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Miercoles 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach ($eventos['conferencias_M'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>

        <h3 class="eventos-registro__heading--workshop">&lt;WorkShop /></h3>
        <p class="eventos-registro__fecha">Lunes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach ($eventos['workshops_L'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Martes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach ($eventos['workshops_M'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Miercoles 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach ($eventos['workshops_Mi'] as $evento) : ?>
                <?php include 'evento.php' ?>
            <?php endforeach; ?>
        </div>
    </main>
    <aside class="registro">
        <h3 class="registro__heading">Tu Registro</h3>
        <div id="registro-resumen" class="registro__resumen"></div>

        <div class="registro__regalo">
            <label for="regalo" class="registro__label">Seleccione un regalo</label>
            <select id="regalo" class="registro__select">
                <option value="" selected disabled>--Seleccione un relago--</option>
                <?php foreach($regalos as $regalo): ?>
                    <option class="registro__option" value="<?php echo $regalo->Id ?>"><?php echo $regalo->Nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <form class="formulario" id="registro">
            <div class="formulario__campo">
                <input type="submit" class="formulario__submit formulario__submit--registrar" value="Registrar">
            </div>
        </form>
    </aside>
</div>