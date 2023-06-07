<?php
    // require_once(MODEL_PATH . "connect.php");
    class home_dao {
        static $_instance;

        private function __construct() {
        }
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        public function select_data_carrusel($db) {
            $sql= "SELECT * FROM `marca` ORDER BY cod_marca ASC LIMIT 30;";
            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
        public function select_data_category($db) {
            $sql= "SELECT * FROM combustible ORDER BY cod_combustible DESC";
            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
        public function select_carroceria($db) {
            $sql= "SELECT *FROM carroceria ORDER BY cod_carroceria DESC";
            $stmt = $db -> ejecutar($sql);			
            return $db -> listar($stmt);
        }
        public function select_data_type($db) {
            $sql= "SELECT * FROM categoria";

            $stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
        public function select_visit($db){
            $sql= "SELECT distinct cod_modelo,img_car FROM car ORDER BY visitas DESC limit 4";
			$stmt = $db -> ejecutar($sql);
            return $db -> listar($stmt);
        }
    }
?>