<?php

class cart_bll
{

	private $dao;
	private $db;
	static $_instance;

	function __construct()
	{
		$this->dao = cart_dao::getInstance();
		$this->db = db::getInstance();
	}

	public static function getInstance()
	{
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    public function get_load_cart_BLL($args){
        $token = middleware::decode_token($args);
		return $this->dao->select_user_cart($this->db, $token['username']);
    }
	public function get_insert_cart_BLL($args){
        $token = middleware::decode_token($args[1]);
		return $this->dao->insert_product($this->db, $token['username'],$args[0]);
    }
	public function get_delete_cart_BLL($args){
        $token = middleware::decode_token($args[1]);
		return $this->dao->delete_cart($this->db, $args[0], $token['username']);
    }
	public function get_update_qty_BLL($args){
        $token = middleware::decode_token($args[0]);
		return $this->dao->update_qty($this->db, $token['username'], $args[1], $args[2]);
    }
	public function get_checkout_BLL($args){
        $token = middleware::decode_token($args);
		$rdo = $this->dao->select_user_cart($this->db, $token['username']);
		
        foreach($rdo as $fila){
            // $cod_ped = $username;
            $id_car = $fila["id_car"];
            $precio = $fila["precio"];
            $total_precio = $fila["precio"]*$fila["quanty"];
			$this->dao->checkout($this->db, $token['username'],$precio,$id_car,$total_precio);
        }
		return "ok";
       
    }
}