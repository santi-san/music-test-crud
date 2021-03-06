<?php
/** @var array $stmt
 *  @var int $cantidad_de_filas
 *
 */
?>
<!-- Filtrar resultados de generos -->
<form action="" method="get">
    <div class="row mb-3">
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="search">Nombre del genero</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Jazz" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
    </form>

        <!-- Tabla listado de generos -->
<div class="table-responsive">
    <table class="table align-middle table-striped table-borderless mt-5">
        <thead class="bg-white">
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
                    <td> <?= $fila['nomGenero']?> </td>
                    <td>
                        <a onclick="return confirm('¿Estás seguro de querer editar el genero: <?= $fila['nomGenero']?>?');" href="editar_genero.php?id_genero=<?= $fila['id_genero'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 align-middle me-2"><title>Editar</title><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </a>

                        <a onclick="return confirm('¿Estás seguro de querer eliminar el genero: <?= $fila['nomGenero']?>?');" href="eliminar_genero.php?id_genero=<?= $fila['id_genero'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2">
                                <title>eliminar</title>
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                           </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        <tfoot class="bg-white">
            <tr>
                <td colspan="2" class="text-center"> Se encontraron <?= $cantidad_de_filas ?> resultados</td>
            </tr>
        </tfoot>
        </table>
</div>