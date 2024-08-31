<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia Sesion en DevWebcamp</p>

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
            value="<?php echo $usuario->Email ?>"
            >
        </div>
        <div class="formulario__campo">
            <label for="Password" class="formulario__label">Password</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Tu Password"
            id="Password"
            name="Password"
            >
        </div>
        <input type="submit" value="Iniciar Sesión" class="formulario__submit">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlaces">¿Aún no tienes una Cuenta? Obtener una</a>
        <a href="/olvide" class="acciones__enlaces">¿Olvidaste tu Password?</a>
    </div>
</main>
