<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu Cuenta DevWebCamp</p>
    <?php
    require __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if (isset($alertas['exito'])) : ?>
        <div class="acciones--centrar">
            <a href="/login" class="acciones__enlaces">¿Ya tienes un cuenta? Iniciar Sesión</a>
        </div>
    <?php endif; ?>
</main>