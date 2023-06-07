<?php
    class controller_search {
        
        function search_marca(){
            echo json_encode(common::load_model('search_model', 'get_car_brand'));

        }
        function search_categoria_null(){
            // echo json_encode("hola categoria null");
            echo json_encode(common::load_model('search_model', 'get_categoria_null'));            
        }
        function search_categoria(){
            // echo json_encode($_POST['marca']);
            echo json_encode(common::load_model('search_model', 'get_categoria_marca', $_POST['marca']));            
        }
        
        function autocomplete() {
            // echo json_encode($_POST['city']);
            if (!empty($_POST['categoria']) && empty($_POST['marca'])){
                echo json_encode(common::load_model('search_model', 'get_auto_cat', [$_POST['categoria'], $_POST['city']]));
            }else if(empty($_POST['categoria']) && !empty($_POST['marca'])){
                echo json_encode(common::load_model('search_model', 'get_auto_marca', [$_POST['marca'], $_POST['city']]));
            }else if(!empty($_POST['categoria']) && !empty($_POST['marca'])){
                echo json_encode(common::load_model('search_model', 'get_auto_cat_marca', [$_POST['categoria'], $_POST['marca'], $_POST['city']]));
            }else {
                echo json_encode(common::load_model('search_model', 'get_auto_city', $_POST['city']));
            }
        }
    }
?>