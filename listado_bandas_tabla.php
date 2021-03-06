<?php
/** @var array $stmt
 *  @var int $cantidad_de_filas
 *
 */
?>
<!-- Filtrar resultados de bandas -->
<form action="" method="get" class="row gy-2" >

        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="nomdiscog">Nombre</label>
            <input type="text" class="form-control" name="search" id="nomdiscog" placeholder="The Beatles" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
</form>

<!-- Tabla listado de bandas -->
<div class="table-responsive">
    <table class="table align-middle table-striped table-borderless  table-dark mt-5">
        <thead class="table-light">
            <tr>
                <th>Nombre:</th>
                <th>Integrantes:</th>
                <th>Cover:</th>
                <th>Fundacion:</th>
                <th>Pais:</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($fila = $stmt->fetch()){
            $fecha_a_formatear = date_create_from_format('Y-m-d H:i:s', $fila['fechaFundacion']);
            $fecha_corta = date_format($fecha_a_formatear, 'm-Y');
            $fecha_larga = date_format($fecha_a_formatear, 'd-m-Y');
            ?>
            <tr>
                <td class="text-capitalize"> <?= $fila['nomBanda']?> </td>
                <td class="text-capitalize"> <?= $fila['integrantes']?> </td>
                <td class="text-capitalize"> <img src="<?= $fila['imgBanda']?> " class="img-fluid" style="max-width: 45px;max-height: 45px;" alt="<?= $fila['nomBanda']?>"></td>
                <td class="text-nowrap" title="<?= $fecha_larga ?>"><?= $fecha_corta ?></td>
                <td class="text-capitalize text-nowrap"> <?= $fila['nomNacionalidad']?> </td>
                <td>
                    <a onclick="return confirm('¿Estás seguro de querer editar: <?= $fila['nomBanda'] ?> de bandas?');" href="editar_banda.php?id_bandas=<?= $fila['id_bandas'] ?>">
                        <i class="fas fa-edit" title="editar"></i>
                    </a>
                    <br>
                    <a onclick="return confirm('¿Estás seguro de querer editar: <?= $fila['nomBanda'] ?> de bandas?');" href="eliminar.php?id_bandas=<?= $fila['id_bandas'] ?>">
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