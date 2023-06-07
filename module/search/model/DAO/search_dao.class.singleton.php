<?php
    class search_dao{
        static $_instance;

        private function __construct() {
        }
    
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        function select_car_brand($db){

            $sql="SELECT * FROM marca";

			$stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
        function select_categoria_null($db){

            $sql="SELECT DISTINCT * FROM categoria";

			$stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }
        function select_cat_marca($db,$marca){
        $sql="SELECT DISTINCT cat.nombre_cat, cat.cod_categoria
        FROM car c, modelo m, categoria cat
        WHERE c.cod_modelo = m.cod_modelo AND c.categoria = cat.cod_categoria and m.cod_marca  LIKE '$marca'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        }
        function select_auto_city($db,$city){

        $sql="SELECT *
        FROM car c
        WHERE c.city LIKE '$city%';";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        }
        function select_auto_cat($db,$categoria,$city){

        $sql="SELECT c.city, cat.nombre_cat 
        FROM car c, categoria cat  
        WHERE c.categoria = cat.cod_categoria AND cat.cod_categoria LIKE '$categoria' AND c.city LIKE '$city%'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        }

        function select_auto_marca($db,$marca,$city){

        $sql="SELECT ma.cod_marca, c.city
        FROM car c, modelo m, marca ma
        WHERE c.cod_modelo = m.cod_modelo AND m.cod_marca = ma.descripcion AND c.city LIKE '$city%' 
        AND ma.descripcion LIKE '$marca'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        }

        function select_auto_marca_city($db,$categoria,$marca,$city){

        $sql="SELECT c.*, cat.nombre_cat , ma.cod_marca
        FROM car c, categoria cat, modelo mo, marca ma
        WHERE c.categoria = cat.cod_categoria AND mo.cod_modelo = c.cod_modelo 
        AND mo.cod_marca = ma.descripcion  AND ma.descripcion = '$marca' AND
        cat.cod_categoria LIKE '$categoria' AND c.city LIKE '$city%'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
        }
    }

?>