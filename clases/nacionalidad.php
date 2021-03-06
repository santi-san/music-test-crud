<?php


class Nacionalidad {

    public $id_nacionalidad;
    public $nomNacionalidad;

    public function __construct($id_nacionalidad = null)
    {
        if (isset($id_nacionalidad)) {
            echo 'hola';
            /*$this->rellenarDatosPorId($id_producto);*/
        }
    }

    public function getEditPorId($id_nacionalidad)
    {
        $stmt = DB::getStatement('SELECT * FROM nacionalidades WHERE id_nacionalidad = :id_nacionalidad');
        $stmt->bindParam(':id_nacionalidad', $id_nacionalidad, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function update($id_nacionalidad = null)
    {
        if (isset($id_nacionalidad)) {

            $sql =
                "
                UPDATE nacionalidades
                SET
                nomNacionalidad = :nomNacionalidad
                WHERE id_nacionalidad = :id_nacionalidad;
                ";

            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_nacionalidad', $this->id_nacionalidad, PDO::PARAM_INT);
            $stmt->bindParam(':nomNacionalidad', $this->nomNacionalidad, PDO::PARAM_STR);


            //se ejecuta el insert
            $stmt->execute();
        } else {
            echo 'no recibio el id';
        }
    }

    public function eliminarPorId($id_nacionalidad = null)
    {
        if (isset($id_nacionalidad)) {
            $this->id_nacionalidad = $id_nacionalidad;
            $sql = "DELETE FROM nacionalidades WHERE id_nacionalidad = :id_nacionalidad";
            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_nacionalidad', $this->id_nacionalidad, PDO::PARAM_INT);
            //se ejecuta el insert
            $stmt->execute();
        } else {
            echo '?????';
        }
    }

    public function insert()
    {
        $sql = "
            INSERT INTO nacionalidades
            ( nomNacionalidad )
            VALUES
            ( :nombreNacionalidad )";

        $stmt = DB::getStatement($sql);
        //sql injection
        $stmt->bindParam(':nombreNacionalidad', $this->nomNacionalidad, PDO::PARAM_STR);
        //se ejecuta el insert
        $stmt->execute();
    }


}