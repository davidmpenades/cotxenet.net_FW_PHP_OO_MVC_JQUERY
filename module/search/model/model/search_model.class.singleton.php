<?php
    class search_model {
        private $bll;
        static $_instance;
        
        function __construct() {
            $this -> bll = search_bll::getInstance();
        }

        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        public function get_car_brand() {
            return $this -> bll -> get_car_brand_BLL();
        }
        public function get_categoria_null() {
            return $this -> bll -> get_categoria_BLL();
        }

        public function get_categoria_marca($args) {
            return $this -> bll -> get_cat_marca_BLL($args);
        }
        public function get_auto_cat($args) {
            return $this -> bll -> get_auto_cat_BLL($args);
        }
        public function get_auto_marca($args) {
            return $this -> bll -> get_auto_marca_BLL($args);
        }
        public function get_auto_cat_marca($args) {
            return $this -> bll -> get_cat_marca_city_BLL($args);
        }
        public function get_auto_city($args) {
            return $this -> bll -> get_auto_city_BLL($args);
        }

    }