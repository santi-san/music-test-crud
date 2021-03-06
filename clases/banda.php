<?php


class Banda {
    public $id_bandas;
    public $nomBanda;
    public $integrantes;
    public $fechaFundacion;
    public $imgBanda;
    public $nacionalidades_id_nacionalidad;

    public function __construct($id_bandas = null)
    {
        if (isset($id_bandas))
        {
            echo 'hola';
            /*$this->rellenarDatosPorId($id_bandas);*/
        }
    }

    public function getEditPorId($id_bandas)
    {
        $stmt = DB::getStatement('SELECT * FROM bandas WHERE id_bandas = :id_bandas');
        $stmt->bindParam(':id_bandas', $id_bandas, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function update($id_bandas = null){
        if (isset($id_bandas)) {

            $sql=<<<SQL_INSERT
                UPDATE bandas
                SET
                nomBanda = :nomBanda,
                integrantes = :integrantes,
                fechaFundacion = :fechaFundacion,
                imgBanda = :imgBanda,
                nacionalidades_id_nacionalidad = :nacionalidades_id_nacionalidad
                WHERE id_bandas = :id_bandas;
SQL_INSERT;

            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':nomBanda', $this->nomBanda, PDO::PARAM_STR);
            $stmt->bindParam(':integrantes', $this->integrantes, PDO::PARAM_STR);
            $stmt->bindParam(':fechaFundacion', $this->fechaFundacion, PDO::PARAM_STR);
            $stmt->bindParam(':imgBanda', $this->imgBanda, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidades_id_nacionalidad', $this->nacionalidades_id_nacionalidad, PDO::PARAM_INT);
            $stmt->bindParam(':id_bandas', $this->id_bandas, PDO::PARAM_INT);

            //se ejecuta el insert
            $stmt->execute();
        }
        else {
            echo 'no recibio el id';
        }
    }

    public function  eliminarPorId($id_bandas = null){
        if (isset($id_bandas)) {
            $this->id_bandas = $id_bandas;
            $sql = "DELETE FROM bandas WHERE id_bandas = :id_bandas";
            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_bandas', $this->id_bandas, PDO::PARAM_INT);
            //se ejecuta el insert
            $stmt->execute();
        }
        else{
            echo '?????';
        }
    }

    public function insert(){
        $sql=<<<SQL_INSERT
            INSERT INTO bandas
            (
             nomBanda,
             integrantes,
             fechaFundacion,
             imgBanda,
             nacionalidades_id_nacionalidad
             )
            VALUES
            (
             :nomBanda,
             :integrantes ,
             :fechaFundacion,
             :folderImgBanda,
             :nacionalidades_id_nacionalidad
             )
SQL_INSERT;

        $stmt = DB::getStatement($sql);
        //sql injection
        $stmt->bindParam(':nomBanda', $this->nomBanda, PDO::PARAM_STR);
        $stmt->bindParam(':integrantes', $this->integrantes, PDO::PARAM_STR);
        $stmt->bindParam(':fechaFundacion', $this->fechaFundacion, PDO::PARAM_STR);
        $stmt->bindParam(':folderImgBanda', $this->imgBanda, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidades_id_nacionalidad', $this->nacionalidades_id_nacionalidad, PDO::PARAM_INT);
        //se ejecuta el insert
        $stmt->execute();
    }
}