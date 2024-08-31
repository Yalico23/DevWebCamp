<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Restablecer Password</p>

    <?php 
        include_once __DIR__ . '/../templates/alertas.php';
        
    ?>

    <form class="formulario" method="post">
        <div class="formulario__campo">
            <label for="Email" class="formulario__label">Email</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Tu Email"
            id="Email"
            name="Email"
            >
        </div>
        <input type="submit" value="Enviar Instrucciones" class="formulario__submit">
    </form>

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