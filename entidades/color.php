<?php

class Color {
    private $idcolor;
    private $nombre;
   
    public function __construct(){

    }

    
    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function cargarFormulario($request){
        $this->idcolor = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["nombre"])? $request["nombre"] : "";
    }

    public function insertar(){
        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        //Arma la query
        $sql = "INSERT INTO colores (
                    nombre 
                ) VALUES (
                    '" . $this->nombre ."'
                );";
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idcolor = $mysqli->insert_id;
        //Cierra la conexión
        $mysqli->close();
    }

    public function actualizar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE colores SET
                nombre = '".$this->nombre."'
                WHERE idcolor = " . $this->idcolor;
          
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM colores WHERE idcolor = " . $this->idcolor;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idcolor, 
                        nombre 
                FROM  colores
                WHERE idcolor = " . $this->idcolor;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if($fila = $resultado->fetch_assoc()){
            $this->nombre = $fila["nombre"];
        }  
        $mysqli->close();

    }

    public function ObtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idcolor, nombre FROM colores ";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo
            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Color();
                $entidadAux->idcolor = $fila["idcolor"];
                $entidadAux->nombre = $fila["nombre"];
                $aResultado[] = $entidadAux;
            }
        }
        return $aResultado;
    }

}


?>