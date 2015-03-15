<section class="contenedor-formulario">
    <h2 align="center">Cambiar Contraseña</h2>
    <form id="nueva-clave" action="" autocomplete="off">
        <table class="formulario">
            <tr>
                <td>
                    <label for="clave_nueva">Contraseña Nueva: <i class="fa fa-question-circle fa-fw ayuda" title="<b>Puede estar formado por:</b><br>Mínimo 6 caracteres<br>Máximo 18 caracteres<br>Letras mayúsculas y minúsculas<br>Números<br>Caracteres: * + / : . , $ % & # { } _ -"></i>
                    </label>
                    <br>
                    <input id="clave_nueva" name="clave_nueva" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="clave_nueva2">Confirmar Contraseña:</label>
                    <br>
                    <input id="clave_nueva2" name="clave_nueva2" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="boton" value="Guardar Cambios" />
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