<section class="busqueda">
    <h1 align="center">Usuarios</h1>
    <p>
        <a class="enlace-registrar" href="<?php echo $app['basedir'].'/usuarios/registrar';?>">
            <i class="fa fa-plus fa-fw"></i> Registrar Usuario
        </a>
        <br>
        <input type="text" class="input-buscar" placeholder="Buscar Usuarios" /><i class="fa fa-search fa-fw icono-buscar"></i>
    </p>
    <br>
    <table class="usuarios"></table>
</section>