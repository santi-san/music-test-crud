<?php
/** @var array $stmt
 *  @var int $cantidad_de_filas
 *
 */
?>
<!-- Filtrar resultados de nacionalidades -->
<form action="" method="get">
    <div class="row mb-3">
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="search">Nombre de la nacionalidad</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Rusia" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
</form>

<!-- Tabla listado de nacionalidades -->
<div class="table-responsive">
    <table class="table align-middle table-striped table-borderless table-dark mt-5">
        <thead class="table-light">
            <tr>
                <th>Nombre:</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($fila = $stmt->fetch()){
            ?>
            <tr>
                <td> <?= $fila['nomNacionalidad']?> </td>
                <td>
                    <a onclick="return confirm('¿Estás seguro de querer editar: <?= $fila['nomNacionalidad'] ?> de nacionalidades?');" href="editar_nacionalidad.php?id_nacionalidad=<?= $fila['id_nacionalidad'] ?>"><i class="fas fa-edit" title="editar"></i></a>

                    <a onclick="return confirm('¿Estás seguro de querer eliminar: <?= $fila['nomNacionalidad'] ?> de nacionalidades?');" href="eliminar_nacionalidad.php?id_nacionalidad=<?= $fila['id_nacionalidad'] ?>"><i class="fas fa-trash-alt" title="eliminar"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot class="table-secondary">
            <tr>
                <td colspan="2" class="text-center"> Se encontraron <?= $cantidad_de_filas ?> resultados</td>
            </tr>
        </tfoot>
    </table>
</div>