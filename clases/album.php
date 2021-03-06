<?php


class Album {
    public $id_album;
    public $nomAlbum;
    public $fechaLanzamiento;
    public $catalogo;
    public $tracklist;
    public $imgAlbum;
    public $bandas_id_bandas;
    public $discograficas_id_discografica;
    public $generos_id_genero;
    public $formatos_id_formato;

    public function __construct($id_album = null)
    {
        if (isset($id_album))
        {
            echo 'hola';
            /*$this->rellenarDatosPorId($id_album);*/
        }
    }

    public function getEditPorId($id_album)
    {
        $stmt = DB::getStatement('SELECT * FROM albums WHERE id_album = :id_album');
        $stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function update($id_album = null){
        if (isset($id_album)) {

            $sql=<<<SQL_INSERT
                UPDATE albums
                SET
                nomAlbum = :nomAlbum,
                fechaLanzamiento = :fechaLanzamiento,
                catalogo = :catalogo,
                tracklist = :tracklist,
                imgAlbum = :imgAlbum,
                bandas_id_bandas = :bandas_id_bandas,
                discograficas_id_discografica = :discograficas_id_discografica,
                generos_id_genero = :generos_id_genero,
                formatos_id_formato = :formatos_id_formato
                WHERE id_album = :id_album;
SQL_INSERT;

            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_album', $id_album, PDO::PARAM_INT);
            $stmt->bindParam(':nomAlbum', $this->nomAlbum, PDO::PARAM_STR);
            $stmt->bindParam(':fechaLanzamiento', $this->fechaLanzamiento, PDO::PARAM_STR);
            $stmt->bindParam(':catalogo', $this->catalogo, PDO::PARAM_STR);
            $stmt->bindParam(':tracklist', $this->tracklist, PDO::PARAM_STR);
            $stmt->bindParam(':imgAlbum', $this->imgAlbum, PDO::PARAM_STR);
            $stmt->bindParam(':bandas_id_bandas', $this->bandas_id_bandas, PDO::PARAM_INT);
            $stmt->bindParam(':discograficas_id_discografica', $this->discograficas_id_discografica, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id_genero', $this->generos_id_genero, PDO::PARAM_INT);
            $stmt->bindParam(':formatos_id_formato', $this->formatos_id_formato, PDO::PARAM_INT);

            //se ejecuta el insert
            $stmt->execute();
        }
        else {
            echo 'no recibio el id';
        }
    }

    public function  eliminarPorId($id_album = null){
        if (isset($id_album)) {
            $this->id_album = $id_album;
            $sql = "DELETE FROM albums WHERE id_album = :id_album";
            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_album', $this->id_album, PDO::PARAM_INT);
            //se ejecuta el insert
            $stmt->execute();
        }
        else{
            echo '?????';
        }
    }

    public function insert(){
        $sql=<<<SQL_INSERT
            INSERT INTO albums
            (
             nomAlbum,
             fechaLanzamiento,
             catalogo,
             tracklist,
             imgAlbum,
             bandas_id_bandas,
             discograficas_id_discografica,
             generos_id_genero,
             formatos_id_formato 
             )
            VALUES
            (
             :nomAlbum,
             :fechaLanzamiento,
             :catalogo,
             :tracklist,
             :folderImgAlbum,
             :bandas_id_bandas,
             :discograficas_id_discografica,
             :generos_id_genero,
             :formatos_id_formato
             )
SQL_INSERT;

        $stmt = DB::getStatement($sql);
        //sql injection
        $stmt->bindParam(':nomAlbum', $this->nomAlbum, PDO::PARAM_STR);
        $stmt->bindParam(':fechaLanzamiento', $this->fechaLanzamiento, PDO::PARAM_STR);
        $stmt->bindParam(':catalogo', $this->catalogo, PDO::PARAM_STR);
        $stmt->bindParam(':tracklist', $this->tracklist, PDO::PARAM_STR);
        $stmt->bindParam(':folderImgAlbum', $this->imgAlbum, PDO::PARAM_STR);
        $stmt->bindParam(':bandas_id_bandas', $this->bandas_id_bandas, PDO::PARAM_INT);
        $stmt->bindParam(':discograficas_id_discografica', $this->discograficas_id_discografica, PDO::PARAM_INT);
        $stmt->bindParam(':generos_id_genero', $this->generos_id_genero, PDO::PARAM_INT);
        $stmt->bindParam(':formatos_id_formato', $this->formatos_id_formato, PDO::PARAM_INT);
        //se ejecuta el insert
        $stmt->execute();
    }
}