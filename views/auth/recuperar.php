<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Coloca Tu nuevo Password</p>

    <?php
    include_once __DIR__ . '/../templates/alertas.php';

    ?>

    <?php if (!$error) : ?>
        <form class="formulario" method="post">
            <div class="formulario__campo">
                <label for="Password" class="formulario__label">Contraseña</label>
                <input type="password" class="formulario__input" placeholder="Tu Nueva Contraseña" id="Password" name="Password">
            </div>
            <input type="submit" value="Cambiar Contraseña" class="formulario__submit">
        </form>
    <?php endif; ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlaces">¿Ya tienes un cuenta? Iniciar Sesión</a>
        <a href="/registro" class="acciones__enlaces">¿Aún no tienes una Cuenta? Obtener una</a>
    </div>
</main>

<?php
$script = "
    <script src='/build/js/app.js'></script>
";
?>