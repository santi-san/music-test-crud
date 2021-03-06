<?php
/** @var array $stmt
 *  @var int $cantidad_de_filas
 */
?>
<!-- Filtrar resultados de discograficas -->
<form action="" method="get" class="row gy-2">
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="nomdiscog">Nombre</label>
            <input type="text" class="form-control" name="search" id="nomdiscog" placeholder="Warner Records" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
</form>

<!-- Tabla listado de discograficas -->
<div class="table-responsive">
    <table class="table align-middle table-striped table-borderless table-dark mt-5">
        <thead class="table-light">
            <tr>
                <th>Nombre:</th>
                <th>Fecha:</th>
                <th>Cover:</th>
                <th>Pais:</th>
                <th>Genero:</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($fila = $stmt->fetch()){
            ?>
            <tr>
                <td class="text-capitalize"> <?= $fila['nomDiscografica']?> </td>
                <td class="text-nowrap"><?= $fila['fechaFundacion'] ?></td>
                <td class="text-capitalize"> <img src="<?= $fila['imgDiscografica']?> " class="img-fluid" style="max-width: 45px;max-height: 45px;" alt="<?= $fila['nomDiscografica']?>"> </td>
                <td class="text-capitalize"> <?= $fila['nomNacionalidad']?> </td>
                <td class="text-capitalize"> <?= $fila['nomGenero']?> </td>
                <td>
                    <a onclick="return confirm('¿Estás seguro de querer editar: <?= $fila['nomDiscografica'] ?> de discograficas?');" href="editar_discografica.php?id_discografica=<?= $fila['id_discografica'] ?>">
                        <i class="fas fa-edit" title="editar"></i>
                    </a>
                    <br>
                    <a onclick="return confirm('¿Estás seguro de querer editar: <?= $fila['nomDiscografica'] ?> de discograficas?');" href="eliminar.php?id_discografica=<?= $fila['id_discografica'] ?>">
                        <i class="fas fa-trash-alt" title="eliminar"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot class="table-secondary">
            <tr>
                <td colspan="6" class="text-center"> Se encontraron <?= $cantidad_de_filas ?> resultados</td>
            </tr>
        </tfoot>
    </table>
</div>