<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebcampo</p>

    <?php 
    require_once __DIR__.'/../templates/alertas.php';
    ?>

    <form action="" class="formulario" id="crear-cuenta" method="POST">
        <div class="formulario__campo">
            <label for="Nombre" class="formulario__label">Nombre</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Tu Nombre"
            id="Nombre"
            name="Nombre"
            value="<?php echo $usuario->Nombre ?>"
            >
        </div>
        <div class="formulario__campo">
            <label for="Apellido" class="formulario__label">Apellido</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Tu Apellido"
            id="Apellido"
            name="Apellido"
            value="<?php echo $usuario->Apellido ?>"
            >
        </div>
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
            <i class="formulario__icon ver-password"><svg id="1" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 16l-2 3h4l-2 3" />
            </svg></i>
        </div>
        <div class="formulario__campo">
            <label for="Password2" class="formulario__label">Confirmar Password</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Confirmar Password"
            id="Password2"
            >
            <i class="formulario__icon ver-password2"><svg id="2" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#007DF4" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M13.1 17.936a9.28 9.28 0 0 1 -1.1 .064c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            <path d="M19 16l-2 3h4l-2 3" />
            </svg></i>
        </div>
        <input type="button" value="Iniciar Sesión" class="formulario__submit boton">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlaces">¿Ya tienes un cuenta? Iniciar Sesión</a>
        <a href="/olvide" class="acciones__enlaces">¿Olvidaste tu Password?</a>
    </div>
</main>