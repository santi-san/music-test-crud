<?php
require_once './clases/DB.php';

$link = DB::getConnection();
if (!$link) {
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

/**
 * @var string $nomDiscografica
 * @var string $fechaFundacion
 * @var int $generos_id_genero
 * @var int $nacionalidades_id_nacionalidad
 * @var mysqli $link
*/
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row mb-3 gy-2">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <label for="nomDiscografica">Nombre</label>
            <input type="text" class="form-control" id="nomDiscografica" name="nomDiscografica" autofocus value="<?= $nomDiscografica ?>">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <label for="fechaFundacion">Fecha de fundacion</label>
            <input type="number" min="1900" max="2020" class="form-control" id="fechaFundacion" name="fechaFundacion" value="<?= $fechaFundacion ?>">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <label for="imgAlbum">Cover album</label>
            <input type="file" class="form-control" id="imgAlbum" name="imgAlbum">
        </div>
    </div>
    <div class="row mb-3 gy-2">
        <div class="col-md-6 col-sm-6 col-12">
            <label for="genero">Genero</label>
            <select id="genero" name="genero" class="form-select">
                <option value="">Seleccioná un Genero</option>
                <?php
                //include 'altas_discograficas_genero_options.php';

                $sql = 'SELECT id_genero, nomGenero FROM generos ORDER BY nomGenero';
                $stmt = DB::getStatement($sql);
                $stmt->execute();
                while($fila = $stmt->fetch()){
                    $optionSelected = '';
                    if ($generos_id_genero === $fila['id_genero']) {
                        $optionSelected = 'selected';
                    }
                    echo '<option value="' . $fila['id_genero'] . '" ' . $optionSelected . '>' . $fila['nomGenero'] . '</option>';
                }
                 ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <label for="nacionalidad">Nacionalidad</label>
            <select id="nacionalidad" name="nacionalidad" class="form-select">
                <option value="">Seleccioná una Nacionalidad</option>
                <?php
                //include 'altas_discograficas_nacionalidad_options.php';

                $sql = 'SELECT id_nacionalidad, nomNacionalidad FROM nacionalidades ORDER BY nomNacionalidad';
                $stmt = DB::getStatement($sql);
                $stmt->execute();
                while($fila = $stmt->fetch()){
                    $optionSelected = '';
                    if ($nacionalidades_id_nacionalidad === $fila['id_nacionalidad']) {
                        $optionSelected = 'selected';
                    }

                    echo '<option value="' . $fila['id_nacionalidad'] . '" ' . $optionSelected . '>' . $fila['nomNacionalidad'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="reset" class="btn btn-secondary">Restablecer</button>
</form>
