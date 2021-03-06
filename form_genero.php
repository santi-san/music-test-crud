<?php /** @var string $nomGenero */?>
<form action="" method="post" class="row gy-2">
        <div class="form-group col-lg-10 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="nomGenero">Nombre</label>
            <input type="text" class="form-control" id="nomGenero" name="nomGenero" placeholder="Nombre del genero" autofocus value="<?= $nomGenero ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">ENVIAR</button>
            <input class="btn btn-secondary" type="reset" value="Reset">
        </div>
</form>