<?php

class Discografica {
    public $id_discografica;
    public $nomDiscografica;
    public $fechaFundacion;
    public $imgDiscografica;
    public $nacionalidades_id_nacionalidad;
    public $generos_id_genero;

    public function __construct($id_discografica = null)
    {
        if (isset($id_discografica))
        {
            echo 'hola';
            /*$this->rellenarDatosPorId($id_discografica);*/
        }
    }

    public function getEditPorId($id_discografica)
    {
        $stmt = DB::getStatement('SELECT * FROM discograficas WHERE id_discografica = :id_discografica');
        $stmt->bindParam(':id_discografica', $id_discografica, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function update($id_discografica = null){
        if (isset($id_discografica)) {

            $sql=
                "
                UPDATE discograficas
                SET
                nomDiscografica = :nomDiscografica,
                fechaFundacion = :fechaFundacion,
                imgDiscografica = :imgDiscografica,
                nacionalidades_id_nacionalidad = :nacionalidades_id_nacionalidad,
                generos_id_genero = :generos_id_genero
                WHERE id_discografica = :id_discografica;
                ";

            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_discografica', $this->id_discografica, PDO::PARAM_INT);
            $stmt->bindParam(':nomDiscografica', $this->nomDiscografica, PDO::PARAM_STR);
            $stmt->bindParam(':fechaFundacion', $this->fechaFundacion, PDO::PARAM_INT);
            $stmt->bindParam(':imgDiscografica', $this->imgDiscografica, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidades_id_nacionalidad', $this->nacionalidades_id_nacionalidad  , PDO::PARAM_INT);
            $stmt->bindParam(':generos_id_genero', $this->generos_id_genero, PDO::PARAM_INT);

            //se ejecuta el insert
            $stmt->execute();
        }
        else {
            echo 'no recibio el id';
        }
    }

    public function  eliminarPorId($id_discografica = null){
        if (isset($id_discografica)) {
            $this->id_discografica = $id_discografica;
            $sql = "DELETE FROM discograficas WHERE id_discografica = :id_discografica";
            $stmt = DB::getStatement($sql);
            //sql injection
            $stmt->bindParam(':id_discografica', $this->id_discografica, PDO::PARAM_INT);
            //se ejecuta el insert
            $stmt->execute();
        }
        else{
            echo '?????';
        }
    }

    public function insert(){
        $sql=<<<SQL_INSERT
            INSERT INTO discograficas
            ( nomDiscografica,
              fechaFundacion,
              imgDiscografica,
              generos_id_genero, 
              nacionalidades_id_nacionalidad )
            VALUES
            ( :nomDiscografica,
              :fechaFundacion,
              :folderImgBanda,
              :generos_id_genero,
              :nacionalidades_id_nacionalidad)
SQL_INSERT;

        $stmt = DB::getStatement($sql);
        //sql injection
        $stmt->bindParam(':nomDiscografica', $this->nomDiscografica, PDO::PARAM_STR);
        $stmt->bindParam(':fechaFundacion', $this->fechaFundacion, PDO::PARAM_INT);
        $stmt->bindParam(':folderImgBanda', $this->imgDiscografica, PDO::PARAM_STR);
        $stmt->bindParam(':generos_id_genero', $this->generos_id_genero, PDO::PARAM_INT);
        $stmt->bindParam(':nacionalidades_id_nacionalidad', $this->nacionalidades_id_nacionalidad, PDO::PARAM_INT);
        //se ejecuta el insert
        $stmt->execute();
    }
}