<section class="login-container">
    <h3 align="center">
        <b>Inicio de Sesión</b>
    </h3>
    <form id="form-login" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td>
                    <label for="nombre">Usuario:</label>
                    <br>
                    <input id="nombre" name="nombre" type="text" pattern="^[a-zA-Z0-9_-]{4,16}$" autofocus required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="clave">Contraseña:</label>
                    <br>
                    <input id="clave" name="clave" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" autocomplete="off" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="boton" value="Iniciar Sesión" />
                </td>
            </tr>
            <tr>
                <td>
                    <div class="status"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="javascript:void(0);" class="link forgot-password">¿Olvidó su contraseña?</a>
                </td>
            </tr>
        </table>
    </form>
</section>
<?php echo '<script defer src="'.$app[ 'basedir']. '/js/login.js"></script>'; ?>