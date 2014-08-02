<section class="contenedor-formulario">
    <h2 align="center">Cambiar Contraseña</h2>
    <form id="nueva-clave" action="" autocomplete="off">
        <table class="formulario">
            <tr>
                <td>
                    <label for="clave_actual">Contraseña Actual:</label>
                    <br>
                    <input id="clave_actual" name="clave_actual" type="password" autofocus required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="clave_nueva">Contraseña Nueva:</label>
                    <br>
                    <input id="clave_nueva" name="clave_nueva" type="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="clave_nueva2">Confirmar Contraseña:</label>
                    <br>
                    <input id="clave_nueva2" name="clave_nueva2" type="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="boton" value="Guardar Cambios"/>
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