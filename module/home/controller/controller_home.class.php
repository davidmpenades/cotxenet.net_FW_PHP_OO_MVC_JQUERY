<?php
    class controller_home {
        function view() {
            // echo "hola view";
            common::load_view('top_page_home.html', VIEW_PATH_HOME . 'home.html');
        }

        function Carrousel_Brand() {
            // echo json_encode("hola carrusel");
            echo json_encode(common::load_model('home_model', 'get_carrusel'));
        }
        function carroceria(){
            // echo json_encode("hola carroceria");
            echo json_encode(common::load_model('home_model', 'get_carroceria'));
        }
        function cattype() {
            echo json_encode(common::load_model('home_model', 'get_cattype'));
        }
        
        function type() {
            // echo json_encode('Hola type');
            echo json_encode(common::load_model('home_model', 'get_type'));
        }
        function visit() {
            // echo json_encode('Hola visit');
            echo json_encode(common::load_model('home_model', 'get_visit'));
        }
    }
?>