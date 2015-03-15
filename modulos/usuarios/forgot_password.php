<section class="forgot-password-container">
    <h3 align="center">
        <b>Olvidó su Contraseña</b>
    </h3>
    <form id="form-forgot-password" action="" autocomplete="off">
        <table class="formulario">
            <tr>
                <td>
                    <label for="email">Email:</label>
                    <br>
                    <input name="email" type="text" pattern="^[A-Za-z0-9._%+-]+@([A-Za-z0-9]+\.)+.[A-Za-z]{2,4}$" autofocus required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="boton" value="Enviar" />
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
<?php echo '<script async defer src="'.$app[ 'basedir']. '/js/forgot-password.js"></script>'; ?>