<?php
    class shop_model {

        private $bll;
        static $_instance;
        
        function __construct() {
            $this -> bll = shop_bll::getInstance();
        }

        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        public function get_list($args){
            return $this -> bll -> get_list_BLL($args);
        }
        public function get_count() {
            return $this -> bll -> get_count_BLL();
        }
        public function get_all_cars($args) {
            return $this -> bll -> get_all_cars_BLL($args);
        }
        public function get_count_filters($args) {
            return $this -> bll -> get_count_filter_BLL($args);
        }
        public function get_filter($args) {
            return $this -> bll -> get_filter_BLL($args);
        }
        public function get_car($args) {
            return $this -> bll -> get_car_BLL($args);
        }
        public function get_related($args){
            return $this -> bll -> get_related_BLL($args);
        }
        public function get_cars_related($args){
            return $this -> bll -> get_related_car_BLL($args);
        }
        public function get_control_likes($args){
            return $this -> bll -> get_control_likes_BLL($args);
        }
        public function get_load_likes_user($args){
            return $this -> bll -> get_load_likes_user_BLL ($args);
        }
    }
?>