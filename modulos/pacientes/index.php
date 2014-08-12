<section class="busqueda">
    <h1 align="center">Pacientes</h1>
    <p>
        <a class="enlace-registrar" href="<?php echo $app['basedir'].'/pacientes/registrar';?>">
            <i class="fa fa-plus fa-fw"></i> Registrar Paciente
        </a>
        <br>
        <input type="text" class="input-buscar" placeholder="Buscar Pacientes" /><i class="fa fa-search fa-fw icono-buscar"></i>
    </p>
    <br>
    <table class="pacientes"></table>
</section>