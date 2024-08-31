<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Nombre">Nombre Evento</label>
        <input 
        type="text"
        class="formulario__input"
        id="Nombre"
        name="Nombre"
        placeholder="Nombre Evento"
        value="<?php echo $evento->Nombre ?? ''?>"
        >
    </div>
    
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Descripcion">Descripcion del Evento</label>
        <textarea 
        type="text"
        class="formulario__input formulario__input--textarea"
        id="Descripcion"
        name="Descripcion"
        placeholder="Descripcion Evento"
        ><?php echo $evento->Descripcion ?? ''?></textarea>
    </div>
    
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Categoria">Categoria o tipo de Evento</label>
        <select name="Categoria_id" id="Categoria" class="formulario__input">
            <option selected disabled>--Seleccione una opcion--</option>
            <?php foreach($categorias as $categoria): ?>
                <option 
                <?php echo $categoria->Id === $evento->Categoria_id ? 'selected' : '' ?> 
                value="<?php echo $categoria->Id ?>">
                    <?php echo $categoria->Nombre ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Dia_id">Seleccione el Dia</label>
        <div class="formulario__radio">
            <?php foreach($dias as $dia): ?>
                <div class="formulario__radio--opciones">
                    <label for="<?php echo strtolower($dia->Nombre)?>"><?php echo $dia->Nombre ?></label>
                    <input 
                    type="radio" 
                    name="dia" 
                    id="<?php echo strtolower($dia->Nombre) ?>"
                    value="<?php echo $dia->Id ?>"
                    <?php 
                        echo ($evento->Dia_id === $dia->Id) ? 'checked' : '';
                    ?>
                    >
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="Dia_id" value="<?php echo $evento->Dia_id ?>">
    </div>

    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima">Seleccionar Hora</label>
        <ul class="horas" id="horas">
            <?php foreach($horas as $hora): ?>
                <li class="horas__hora horas__hora--deshabilitado" data-hora-id="<?php echo $hora->Id ?>"><?php echo $hora->Hora; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" name="Hora_id" value="<?php echo $evento->Hora_id?>">
    </div>
    
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>
    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Ponentes">Ponente</label>
        <input 
        type="text"
        class="formulario__input"
        id="Ponentes"
        placeholder="Buscar Ponente"
        >
        <ul class="listado-ponentes" id="ulPonente"></ul>

        <input type="hidden" name="Ponente_id" value="<?php echo $evento->Ponente_id?>">
    </div>

    <div class="formulario__campo formulario__campo--encima">
        <label class="formulario__label formulario__label--encima" for="Disponibles">Lugares Disponibles</label>
        <input 
        type="number"
        min="1"
        class="formulario__input"
        id="Disponibles"
        placeholder="Ej: 20"
        name="Disponibles"
        value="<?php echo $evento->Disponibles; ?>"
        >
    </div>
</fieldset>