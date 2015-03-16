<section class="contenedor-formulario">
    <h2 align="center">Reestablecer Contraseña</h2>
    <form id="form-password-reset" action="" autocomplete="off">
        <table class="formulario">
            <tr>
                <td class="oculto">
                    <input name="token" type="text" value="<?php echo $token ?>">
                </td>
                <td>
                    <label for="new_password">Contraseña Nueva: <i class="fa fa-question-circle fa-fw ayuda" title="<b>Puede estar formado por:</b><br>Mínimo 6 caracteres<br>Máximo 18 caracteres<br>Letras mayúsculas y minúsculas<br>Números<br>Caracteres: * + / : . , $ % & # { } _ -"></i>
                    </label>
                    <br>
                    <input name="new_password" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" autofocus required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <br>
                    <input name="password_confirmation" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="boton" value="Guardar Datos" />
                </td>
            </tr>
            <tr>
                <td>
                    <div class="status"></div>
                </td>
            </tr>
        </table>
    </form>
</section>
<?php echo '<script defer src="'.$app[ 'basedir']. '/js/password-reset.js"></script>'; ?>