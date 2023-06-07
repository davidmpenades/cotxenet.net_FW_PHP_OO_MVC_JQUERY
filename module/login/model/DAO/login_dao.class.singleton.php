<?php
class login_dao
{
    static $_instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function control_registro_mail($db, $email)
    {
        $sql = "SELECT COUNT(*) as 'existe' FROM users WHERE email='$email'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function control_registro_user($db, $user)
    {
        $sql = "SELECT COUNT(*) as 'existe' FROM users WHERE username ='$user'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function insert_user($db, $user, $email, $password, $avatar,$token_email)
    {
        $sql = "INSERT INTO `users`(`username`, `password`, `email`, `avatar`,`token_email`, `isActive`) 
            VALUES ('$user','$password','$email','$avatar','$token_email',0)";
        
        return $db->ejecutar($sql);
    }
    public function seleccionar_usuario($db, $user)
    {
        $sql = "SELECT * FROM `users` WHERE username='$user'";
       

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function select_recover_password($db, $email){
        $sql = "SELECT `email` FROM `users` WHERE email = '$email' AND password NOT LIKE ('')";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function update_recover_password($db, $email, $token_email){
        $sql = "UPDATE `users` SET `token_email`= '$token_email', isActive = 0 WHERE `email` = '$email'";
        $stmt = $db->ejecutar($sql);
        return "ok";
    }
    public function update_new_passwoord($db, $token_email, $password){
        $sql = "UPDATE `users` SET `password`= '$password', `token_email`= '', isActive = 1 WHERE `token_email` = '$token_email'";
        $stmt = $db->ejecutar($sql);
        return "done";
    }
    public function data_user($db,$username){
        $sql = "SELECT * FROM users WHERE username like '$username'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function select_verify_email($db, $token_email){

        $sql = "SELECT token_email FROM users WHERE token_email = '$token_email'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    } 

    public function update_verify_email($db, $token_email){

        $sql = "UPDATE users SET isActive = 1, token_email= '' WHERE token_email = '$token_email'";

        $stmt = $db->ejecutar($sql);
        return "update";
    }
    public function  insert_user_social_login($db, $id_user, $username, $email, $avatar) {
        return $id_user;
		// $sql = "INSERT INTO `users`(`id_user`,`username`, `email`, `email_token`, `avatar`,`isActive`) 
		// 		VALUES ('$id_user','$username','$email','','$avatar',1)";
        // // return $sql;
        // return $db->ejecutar($sql);
	}
}
