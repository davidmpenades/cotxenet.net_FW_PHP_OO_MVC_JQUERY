<?php
    class controller_shop {
        function view() {
            common::load_view('top_page_shop.html', VIEW_PATH_SHOP . 'shop.html');
        }
        function list(){
            echo json_encode(common::load_model('shop_model', 'get_list', [$_POST['orderby'], $_POST['total_prod'], $_POST['items']]));
        }
        function count_all() {
            echo json_encode(common::load_model('shop_model', 'get_count'));
        }
        function all_cars(){
            echo json_encode(common::load_model('shop_model', 'get_all_cars', [ $_POST['total_prod'], $_POST['items']]));
        }
        function count_filters(){
            echo json_encode(common::load_model('shop_model', 'get_count_filters',$_POST['filter']));
        }
        function filter(){
            echo json_encode(common::load_model('shop_model', 'get_filter',[$_POST['filter'],$_POST['total_prod'], $_POST['items']]));
        }
        function filter_carro(){
            echo json_encode(common::load_model('shop_model', 'get_filter',[$_POST['filter'],$_POST['total_prod'], $_POST['items']]));
        }
        function filter_marca(){
            echo json_encode(common::load_model('shop_model', 'get_filter',[$_POST['filter'],$_POST['total_prod'], $_POST['items']]));
        }
        function filter_comb(){
            echo json_encode(common::load_model('shop_model', 'get_filter',[$_POST['filter'],$_POST['total_prod'], $_POST['items']]));
        }
        function filter_tipo(){
            echo json_encode(common::load_model('shop_model', 'get_filter',[$_POST['filter'],$_POST['total_prod'], $_POST['items']]));
        }
        function one_car(){
            echo json_encode(common::load_model('shop_model','get_car',[$_POST['id']]));
        }
        function count_cars_related(){
            echo json_encode(common::load_model('shop_model','get_related',$_POST['marca']));
        }
        function cars_related(){
            echo json_encode(common::load_model('shop_model','get_cars_related',[$_POST['marca'],$_POST['items']]));
        }
        function control_likes(){
            echo json_encode(common::load_model('shop_model','get_control_likes',[$_POST['id_car'],$_POST['token']]));
        }
        function load_likes_user(){
            echo json_encode(common::load_model('shop_model','get_load_likes_user',$_POST['token']));

        }

    }
?>