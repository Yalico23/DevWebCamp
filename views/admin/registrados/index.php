<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="dashboard__contenedor">
    <?php if (!empty($registros)) : ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th">Usuario</th>
                    <th class="table__th">Email</th>
                    <th class="table__th">Plan</th>
                    <th class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($registros as $registro): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $registro->Usuario->Nombre." ".$registro->Usuario->Apellido ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro->Usuario->Email?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro->Paquete->Nombre ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php else : ?>
        <p class="text-center">No Hay Registros Aún</p>
    <?php endif; ?>
</div>
<?php 
    echo $paginacion; //solo descomentar para usar paginacion del curso y no datatables
?>