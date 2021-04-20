<?php

class Auto 
{
    private $idauto;
    private $nombre;
    private $anio;
    private $precio;
    private $descripcion;
    private $imagen;
    private $fk_idcolor;
    private $fk_idmarca;
    private $cantidad;

    public function __construct(){
        $this->cantidad= 0;
        $this->precio= 0.0;

    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    public function cargarFormulario($request){
        $this->idauto = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";
        $this->anio = isset($request["txtFecha"])? $request["txtFecha"]: "";
        $this->precio = isset($request["txtPrecio"])? $request["txtPrecio"] : "";
        $this->descripcion = isset($request["txtDescripcion"])? $request["txtDescripcion"] :"";
        $this->imagen = isset($request["txtImagen"])? $request["txtImagen"] :"";
        $this->fk_idcolor = isset($request["txtColor"])? $request["txtColor"] : "";
        $this->fk_idmarca = isset($request["txtMarca"])? $request["txtMarca"] : "";
        $this->cantidad = isset($request["txtCantidad"])? $request["txtCantidad"]: "";
        
    }
    public function insertar(){
        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        //Arma la query
        $sql = "INSERT INTO autos (
                    nombre, 
                    anio,
                    precio, 
                    descripcion, 
                    imagen,
                    fk_idcolor,
                    fk_idmarca,
                    cantidad

                ) VALUES (
                    '" . $this->nombre ."', 
                    '" . $this->anio ."', 
                    '" . $this->precio ."', 
                    '" . $this->descripcion ."', 
                    '" . $this->imagen ."',
                    '" . $this->fk_idcolor ."', 
                    '" . $this->fk_idmarca ."', 
                    '" . $this->cantidad ."'
                );";
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idproducto = $mysqli->insert_id;
        //Cierra la conexión
        $mysqli->close();
    }

    public function actualizar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE autos SET
                nombre = '".$this->nombre."',
                anio = '".$this->anio."',
                precio = '".$this->precio."',
                descripcion = '".$this->descripcion."',
                imagen = '".$this->imagen."',
                fk_idcolor = '".$this->fk_idcolor."',
                fk_idmarca = '".$this->fk_idmarca."',
                cantidad = '".$this->cantidad."'
                WHERE idauto = " . $this->idauto;
          
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM autos WHERE idauto = " . $this->idauto;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idauto, 
                        nombre, 
                        anio,
                        precio, 
                        descripcion,  
                        imagen,
                        fk_idcolor,
                        fk_idmarca,
                        cantidad 
                FROM autos 
                WHERE idauto = " . $this->idauto;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if($fila = $resultado->fetch_assoc()){
            $this->idauto = $fila["idauto"];
            $this->nombre = $fila["nombre"];
            $this->anio = $fila["anio"];
            $this->precio = $fila["precio"];
            $this->descripcion = $fila["descripcion"];
            $this->imagen = $fila["imagen"];
            $this->fk_idcolor = $fila["fk_idcolor"];
            $this->fk_idmarca = $fila["fk_idmarca"];
            $this->cantidad = $fila["cantidad"];
        }  
        $mysqli->close();

    }

    public function ObtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idauto, 
                    nombre, 
                    anio, 
                    precio,
                    descripcion,
                    imagen,
                    fk_idcolor,
                    fk_idmarca, 
                    cantidad 
                    FROM autos";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo
            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Auto();
                $entidadAux->idauto = $fila["idauto"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->anio = $fila["anio"];
                $entidadAux->precio = $fila["precio"];
                $entidadAux->descripcion = $fila["descripcion"];
                $entidadAux->imagen = $fila["imagen"];
                $entidadAux->fk_idcolor = $fila["fk_idcolor"];
                $entidadAux->fk_idmarca = $fila["fk_idmarca"];
                $entidadAux->cantidad = $fila["cantidad"];
                $aResultado[] = $entidadAux;
            }
        }
        return $aResultado;
    }
    public function fBuscarPrecio($idauto){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT
         idauto,
         precio 
        FROM autos
        WHERE idauto = $idauto
        ORDER BY idauto DESC";
        
       $resultado = $mysqli->query($sql);

       while ($fila = $resultado->fetch_assoc()){
           $precio = $fila["precio"];
       }
           return $precio;
    }
    public function cargarGrilla(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql= "SELECT  
        A.idauto,
        A.nombre,
        A.anio,
        A.cantidad,
        A.imagen,
        A.fk_idcolor,
        B.nombre AS nombre_color,
        A.fk_idmarca,
        A.descripcion,
        A.precio,
        C.nombre AS nombre_marca
       FROM autos A
       INNER JOIN colores B ON A.fk_idcolor = B.idcolor
       INNER JOIN marcas C ON A.fk_idmarca = C.idmarca
       ORDER BY A.anio DESC";
    if (!$resultado = $mysqli->query($sql)) {
        printf("Error en query: %s\n", $mysqli->error . " " . $sql);
    }

    $aResultado = array();
    if($resultado){
        //Convierte el resultado en un array asociativo
        while($fila = $resultado->fetch_assoc()){
            $entidadAux = new Auto();
            $entidadAux->idauto = $fila["idauto"];
            $entidadAux->nombre = $fila["nombre"];
            $entidadAux->fk_idcolor = $fila["fk_idcolor"];
            $entidadAux->fk_idmarca = $fila["fk_idmarca"];
            $entidadAux->anio = $fila["anio"];
            $entidadAux->imagen = $fila["imagen"];
            $entidadAux->cantidad = $fila["cantidad"];
            $entidadAux->precio = $fila["precio"];
            $entidadAux->nombre_color = $fila["nombre_color"];
            $entidadAux->nombre_marca = $fila["nombre_marca"];
            $entidadAux->descripcion = $fila["descripcion"];
            $aResultado[] = $entidadAux;
        }
    }
    return $aResultado;
    }

}
?>