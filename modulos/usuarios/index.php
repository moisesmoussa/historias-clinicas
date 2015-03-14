<section class="busqueda">
    <h1 align="center">Usuarios</h1>
    <p>
        <a class="enlace-registrar" href="<?php echo $app['basedir'].'/usuarios/registrar';?>">
            <i class="fa fa-plus fa-fw"></i> Registrar Usuario
        </a>
        <br>
        <input type="text" class="input-buscar" placeholder="Buscar Usuarios" /><i class="fa fa-search fa-fw icono-buscar"></i>
        <br>
        <input type="checkbox" class="buscar-instantaneo" />
        <label class="texto-checkbox">Búsqueda Instantánea</label>
        <label class="borrar-varios oculto">
            <i class="fa fa-trash-o fa-fw"></i> Eliminar Seleccionados
        </label>
    </p>
    <nav>
        <label>Ordenar por</label>
        <select class="order-by">
            <option value="cedula-ASC">Cédula: Menor a mayor</option>
            <option value="cedula-DESC">Cédula: Mayor a menor</option>
            <option value="nombres-ASC">Nombre: A - Z</option>
            <option value="nombres-DESC">Nombre: Z - A</option>
            <option value="apellidos-ASC">Apellido: A - Z</option>
            <option value="apellidos-DESC">Apellido: Z - A</option>
        </select>
        <label>Mostrar</label>
        <select class="show">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
            <option value="ALL">Todos</option>
        </select>
        <label>por página</label>
        <br>
        <br>
        <label class="showing"></label>
        <ul class="pagination"></ul>
    </nav>
    <br>
    <br>
    <div class="table-wrapper">
        <table class="usuarios"></table>
    </div>
    <br>
    <nav class="bottom-pagination">
        <label class="showing"></label>
        <ul class="pagination"></ul>
    </nav>
    <br>
</section>