<?php
require_once 'DB.php';

class Genero {

    public $id_genero;
    public $nomGenero;

    public function __construct($id_genero = null)
    {
        if (isset($id_genero)) {
            echo 'hola';
            /*$this->rellenarDatosPorId($id_producto);*/
        }
    }

    public function getEditPorId($id_genero)
    {
        $stmt = DB::getStatement('SELECT * FROM generos WHERE id_genero = :id_genero');
        $stmt->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function update($id_genero = null)
    {
        if (isset($id_genero)) {

            $sql = "
                    UPDATE generos
                    SET
                    nomGenero = :nomGenero
                    WHERE id_genero = :id_producto
                    ";

            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_producto', $this->id_genero, PDO::PARAM_INT);
            $stmt->bindParam(':nomGenero', $this->nomGenero, PDO::PARAM_STR);
            //se ejecuta el insert
            $stmt->execute();
        } else {
            echo 'no recibio el id';
        }
    }

    public function eliminarPorId($id_genero = null)
    {
        if (isset($id_genero)) {
            $this->id_genero = $id_genero;
            $sql = "DELETE FROM generos WHERE id_genero = :id_genero";
            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_genero', $this->id_genero, PDO::PARAM_INT);
            //se ejecuta el insert
            $stmt->execute();
        } else {
            echo '?????';
        }
    }

    public function insert()
    {
        $sql = "
            INSERT INTO generos
            ( nomGenero )
            VALUES
            ( :nomGenero )";

        $stmt = DB::getStatement($sql);
        //sql injection
        $stmt->bindParam(':nomGenero', $this->nomGenero, PDO::PARAM_STR);
        //se ejecuta el insert
        $stmt->execute();
    }


}