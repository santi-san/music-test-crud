<?php
require_once './clases/DB.php';

$link = DB::getConnection();
if (!$link) {
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

/**
 * @var string $nomBanda
 * @var string $integrantes
 * @var string $fechaFundacion
 * @var int $nacionalidades_id_nacionalidad
 * @var mysqli $link
 */
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row mb-3 gy-2">
        <div class="col-lg-6 col-md-6 col-sm-4 col-12">
            <label for="nomBanda">Nombre</label>
            <input type="text" class="form-control" id="nomBanda" name="nomBanda" autofocus value="<?= $nomBanda ?>">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <label for="integrantes">Nombre Integrantes</label>
            <input type="text" class="form-control" id="integrantes" name="integrantes" value="<?= $integrantes ?>">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-12">
            <label for="fechaFundacion">Fecha de fundacion</label>
            <input type="date" class="form-control" id="fechaFundacion" name="fechaFundacion" value="<?= $fechaFundacion ?>">
        </div>
    </div>
    <div class="row mb-3 gy-2">
        <div class="col-md-6 col-sm-6 col-12">
            <label for="imgBanda">Cover banda</label>
            <input type="file" class="form-control" id="imgBanda" name="imgBanda">
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <label for="nacionalidad">Nacionalidad</label>
            <select id="nacionalidad" name="nacionalidad" class="form-select">
                <option value="">Seleccioná una Nacionalidad</option>
                <?php

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
