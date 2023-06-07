<?php
    class controller_login {

        function view() {
            common::load_view('top_page_login.html', VIEW_PATH_LOGIN . 'login_register.html');
        }
        function recover_view() {
            common::load_view('top_page_login.html', VIEW_PATH_LOGIN . 'recover_pass.html');
        }
        function register(){
            echo json_encode(common::load_model('login_model', 'get_register', [ $_POST['username_reg'], $_POST['email_reg'], $_POST['passwd1_reg']]));
        }
        function verify_email() {
            echo json_encode(common::load_model('login_model', 'get_verify_email', $_POST['token_email']));
            // echo json_encode($verify);
        }
        function verify_token() {
            // echo json_encode($_POST['token_email']);
            echo json_encode(common::load_model('login_model', 'get_verify_token', $_POST['token_email']));
        }
        function login(){
            // echo json_encode("hola login class");
            echo json_encode(common::load_model('login_model', 'get_login', [$_POST['username_log'], $_POST['passwd_log']]));
        }
        function send_recover_email() {
            echo json_encode(common::load_model('login_model', 'get_recover_email', $_POST['email_forg']));
        }
        function new_password() {
            // echo json_encode([$_POST['token_email'], $_POST['password']]);
            echo json_encode(common::load_model('login_model', 'get_new_password', [$_POST['token_email'], $_POST['password']]));
            // if (!empty($password)) {
            //     echo $password;
            //     return;
            // }
        } 
        function data_user(){
            // echo json_encode($_POST['token']);
            echo json_encode(common::load_model('login_model', 'get_data_user', $_POST['token']));
        }
        function logout(){
            // echo  json_encode("hola logout");
            echo json_encode(common::load_model('login_model','get_logout'));
        }
        function actividad(){
            echo json_encode(common::load_model('login_model','get_actividad'));
        }
        function controluser(){
            echo json_encode(common::load_model('login_model','get_controluser',$_POST['token']));
        }
        function refresh_token(){
            echo json_encode(common::load_model('login_model','get_refresh_token',$_POST['token']));
        }
        function refresh_cookie(){
            echo json_encode(common::load_model('login_model','get_refresh_cookie'));
        }
        function social_login(){
            echo json_encode(common::load_model('login_model','get_social_login', [$_POST['id'], $_POST['username'], $_POST['email'], $_POST['avatar']]));
        }
    }   
?>