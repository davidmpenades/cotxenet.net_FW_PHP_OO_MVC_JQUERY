<?php
    // require_once(MODEL_PATH . "connect.php");
    class cart_dao {
        static $_instance;

        private function __construct() {
        }
        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

    function select_product($db, $username, $id_car){
        $sql = "SELECT * FROM cart WHERE username='$username' AND id_car='$id_car'";
        $stmt = $db -> ejecutar($sql);
        return $db -> listar($stmt);        
    }

    function insert_product($db,$username, $id_car){
        $sql = "INSERT INTO cart (username, id_car, quanty) VALUES ('$username','$id_car', '1')";
        $stmt = $db -> ejecutar($sql);
    }

    function update_product($db,$username, $id_car){
        
        $sql = "UPDATE cart SET quanty = quanty+1 WHERE username='$username' AND id_car='$id_car'";
        $stmt = $db -> ejecutar($sql);
    }

    function select_user_cart($db,$username){
        $sql = "SELECT * FROM cart c, car ca, fotos f, modelo m  
        WHERE c.id_car=ca.id_car AND ca.num_bastidor = f.num_bastidor AND f.img_car LIKE '%pr%' 
        AND m.cod_modelo=ca.cod_modelo AND username='$username' ";
        $stmt = $db -> ejecutar($sql);
        return $db -> listar($stmt);
    }

    function update_qty($db,$username, $id_car, $quanty){
        
        $sql = "UPDATE cart SET quanty = $quanty WHERE username='$username' AND id_car='$id_car'";
        $stmt = $db -> ejecutar($sql);
    }
    
    function delete_cart($db, $id_car, $username){
        $sql = "DELETE FROM cart WHERE username='$username' AND id_car='$id_car'";
        $stmt = $db -> ejecutar($sql);
    }

    function checkout($db,$username, $precio,$id_car, $total_precio){       
        
            $sql = "CALL checkoutOK('$username',$id_car,$precio,$total_precio);";
            $stmt = $db -> ejecutar($sql);
    }

}

?>