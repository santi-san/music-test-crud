<?php
/** @var string $nomNacionalidad */
?>
<form action="" method="post" class="row gy-2">
        <div class="form-group col-lg-10 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="nomNacionalidad">Nombre</label>
            <input type="text" class="form-control" id="nomNacionalidad" name="nomNacionalidad" placeholder="Nombre de la nacionalidad"  autofocus value="<?= $nomNacionalidad ?>">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">ENVIAR</button>
            <input class="btn btn-secondary" type="reset" value="Reset">
        </div>
</form>