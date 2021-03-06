<?php
require_once './clases/DB.php';

$link = DB::getConnection();
if (!$link) {
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

/**
 * @var string $nomAlbum
 * @var string $catalogo
 * @var string $tracklist
 * @var string $fechaLanzamiento
 * @var string $nomAlbum
 * @var int $bandas_id_bandas
 * @var int $discograficas_id_discografica
 * @var int $generos_id_genero
 * @var int $formatos_id_formato
 * @var mysqli $link
 */
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-lg-5 col-md-6 col-sm-6 col-12">
            <label for="nomAlbum">Nombre</label>
            <input type="text" class="form-control" id="nomAlbum" name="nomAlbum" autofocus value="<?= $nomAlbum ?>">
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
            <label for="catologo">Catalogo</label>
            <input type="text" class="form-control" id="catologo" name="catologo" value="<?= $catalogo ?>">
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
            <label for="fechaLanzamiento" class="text-nowrap">Fecha de lanzamiento</label>
            <input type="date" value="<?= $fechaLanzamiento ?>"
                   min="1900-01-01" class="form-control" id="fechaLanzamiento" name="fechaLanzamiento">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <label for="imgAlbum">Cover album</label>
            <input type="file" class="form-control" id="imgAlbum" name="imgAlbum">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-12">
            <label for="bandas">Banda</label>
            <select id="bandas" name="bandas" class="form-select">
                <option value="">Seleccioná una banda</option>fv
                <?php
                $sql = 'SELECT id_bandas, nomBanda FROM bandas ORDER BY nomBanda';
                $stmt = DB::getStatement($sql);
                $stmt->execute();
                while($fila = $stmt->fetch()){
                    $optionSelected = '';
                    if ($bandas_id_bandas === $fila['id_bandas']) {
                        $optionSelected = 'selected';
                    }
                    echo '<option value="' . $fila['id_bandas'] . '" ' . $optionSelected . '>' . $fila['nomBanda'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <label for="discograficas">Discografica</label>
            <select id="discograficas" name="discograficas" class="form-select">
                <option value="">Seleccioná una discografica</option>
                <?php

                $sql = 'SELECT id_discografica, nomDiscografica FROM discograficas ORDER BY nomDiscografica';
                $stmt = DB::getStatement($sql);
                $stmt->execute();
                while($fila = $stmt->fetch()){
                    $optionSelected = '';
                    if ($discograficas_id_discografica === $fila['id_discografica']) {
                        $optionSelected = 'selected';
                    }
                    echo '<option value="' . $fila['id_discografica'] . '" ' . $optionSelected . '>' . $fila['nomDiscografica'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-12">
            <label for="genero">Genero</label>
            <select id="genero" name="genero" class="form-select">
                <option value="">Seleccioná un Genero</option>
                <?php

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
            <label for="formato">Formato</label>
            <select id="formato" name="formato" class="form-select">
                <option value="">Seleccioná un formato</option>
                <?php

                $sql = 'SELECT id_formato, nomFormato FROM formatos ORDER BY nomFormato';
                $stmt = DB::getStatement($sql);
                $stmt->execute();
                while($fila = $stmt->fetch()){
                    $optionSelected = '';
                    if ($formatos_id_formato === $fila['id_formato']) {
                        $optionSelected = 'selected';
                    }
                    echo '<option value="' . $fila['id_formato'] . '" ' . $optionSelected . '>' . $fila['nomFormato'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 col-sm-12 col-12">
            <label for="tracklist">Tracklist</label>
            <textarea class="form-control" id="tracklist" name="tracklist" rows="10"><?= $tracklist ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="reset" class="btn btn-secondary">Restablecer</button>
</form>
