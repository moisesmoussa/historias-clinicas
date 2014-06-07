<section id="cambiar-clave">
    <h2 align="center">Cambiar Contraseña</h2>
    <form id="nueva-clave" action="">
        <table class="formulario">
            <tr>
                <td>
                    <label for="clave_actual">Contraseña Actual:</label>
                    <br>
                    <input id="clave_actual" name="clave_actual" type="password" required>
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
                    <a class="boton" id="clave" href="javascript:void(0);">Guardar Cambios</a>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="status"></div>
                </td>
            </tr>
        </table>
    </form>
</section>