<?php
	class shop_bll {
		private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this -> dao = shop_dao::getInstance();
			$this -> db = db::getInstance();
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		public function get_list_BLL($args){
			return $this -> dao -> select_list_car($this -> db, $args[0],$args[1],$args[2]);
		}
		public function get_count_BLL() {
			return $this -> dao -> select_count($this->db);
		}
		public function get_all_cars_BLL($args) {
			return $this -> dao -> select_all_cars($this->db, $args[0],$args[1]);
		}
		public function get_count_filter_BLL($args) {
			return $this -> dao -> select_count_filter($this->db,$args);
		}
		public function get_filter_BLL($args) {
			return $this -> dao -> select_filter($this->db,$args[0],$args[1],$args[2]);
		}
		public function get_car_BLL($args) {
			return $this -> dao -> select_car($this->db,$args[0]);
		}
		public function get_related_BLL($args) {
			return $this -> dao -> select_count_related($this->db,$args);
		}
		public function get_related_car_BLL($args) {
			return $this -> dao -> select_car_related($this->db,$args[0],$args[1]);
		}
		public function get_control_likes_BLL($args){
			$decode = middleware::decode_token($args[1]);
			$rdo = $this -> dao -> select_likes ($this->db, $args[0], $decode['username']);
			if (!empty($rdo)) {
				return $this -> dao -> delete_likes ($this->db, $args[0], $decode['username']);
			}else{
				return $this -> dao -> insert_likes ($this->db, $args[0], $decode['username']);
			}
		}
		public function get_load_likes_user_BLL($args){
			$decode = middleware::decode_token($args);
			return $this -> dao -> select_load_likes($this->db, $decode['username']);
		}

    }
?>