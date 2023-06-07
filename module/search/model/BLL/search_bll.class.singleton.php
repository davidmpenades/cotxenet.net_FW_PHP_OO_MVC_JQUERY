<?php
	class search_bll {
		private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this -> dao = search_dao::getInstance();
			$this->db = db::getInstance();
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}


		public function get_car_brand_BLL() {
			return $this -> dao -> select_car_brand($this->db);
		}
		public function get_categoria_BLL() {
			return $this -> dao -> select_categoria_null($this->db);
		}

        public function get_cat_marca_BLL($args) {
			return $this -> dao -> select_cat_marca($this->db, $args);
		}
		public function get_auto_cat_BLL($args) {
			return $this -> dao -> select_auto_cat($this->db, $args[0], $args[1]);
		}
		public function get_auto_city_BLL($args) {
			return $this -> dao -> select_auto_city($this->db, $args);
		}
		public function get_auto_marca_BLL($args) {
			return $this -> dao -> select_auto_marca($this->db, $args[0], $args[1]);
		}
		public function get_cat_marca_city_BLL($args){

			return $this -> dao -> select_auto_marca_city($this->db, $args[0], $args[1], $args[2]);
			
		}
		
	}
?>