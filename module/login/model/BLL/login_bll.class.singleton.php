<?php

class login_bll
{

	private $dao;
	private $db;
	static $_instance;

	function __construct()
	{
		$this->dao = login_dao::getInstance();
		$this->db = db::getInstance();
	}

	public static function getInstance()
	{
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function get_register_BLL($args)
	{

		$check_email = $this->dao->control_registro_mail($this->db, $args[1]);
		if ($check_email[0]['existe'] == 0) {
			$check_user = $this->dao->control_registro_user($this->db, $args[0]);
			if ($check_user[0]['existe'] == 0) {
				$hashed_pass = password_hash($args[2], PASSWORD_DEFAULT, ['cost' => 12]);
				$hashavatar = md5(strtolower(trim($args[1])));
				$avatar = "https://i.pravatar.cc/500?u=$hashavatar";
				$token_email = common::generate_token_secure(20);
				$this->dao->insert_user($this->db, $args[0], $args[1], $hashed_pass, $avatar, $token_email);
				$message = [
					'type' => 'validate',
					'token' => $token_email,
					'toEmail' => 'davidmpenades@gmail.com'//envio el verify a mi correo
				// 'toEmail' =>  $args[1]];// cambiaremos el toEmail para uso real
				];
				$email = json_decode(mail::send_email($message), true);
				if (!empty($email)) {
					return;
				}
			} else {
				return 'error_user';
			}
		} else {
			return 'error_email';
		}
	}
	public function get_login_BLL($args)
	{
		$rdo = $this->dao->seleccionar_usuario($this->db, $args[0]);
		$rdo1 = $this->dao->seleccionar_usuario($this->db, $args[0]);

		if (!empty($rdo)) {
			if (password_verify($args[1], $rdo[0]['password']) && $rdo1[0]['isActive'] == 1) {
				$token = middleware::create_token($args[0]);
				$_SESSION['username'] = $rdo[0]['username']; //Guardamos el usuario 
				$_SESSION['tiempo'] = time(); //Guardamos el tiempo que se logea				
				return $token;
			} else if (password_verify($args[1], $rdo[0]['password']) && $rdo1[0]['isActive'] == 0) {
				return 'activate error';
			} else {
				return "error_passwd";
			}
		} else {
			return 'error_user';
		}
	}
	public function get_verify_email_BLL($args)
	{

		if ($this->dao->select_verify_email($this->db, $args)) {
			$this->dao->update_verify_email($this->db, $args);
			return 'verify';
		} else {
			return 'fail';
		}
	}
	public function get_data_user_BLL($args)
	{
		$token = middleware::decode_token($args);
		return $this->dao->data_user($this->db, $token['username']);
	}

	public function get_logout_BLL()
	{
		unset($_SESSION['username']);
		unset($_SESSION['tiempo']);
		session_destroy();

		return "done";
	}

	public function get_actividad_BLL()
	{
		if (!isset($_SESSION["tiempo"])) {
			return "inactivo";
		} else {
			if ((time() - $_SESSION["tiempo"]) >= 1800) {
				return "inactivo";
			} else {
				return (time() - $_SESSION["tiempo"]);
			}
		}
	}
	public function get_controluser_BLL($token)
	{

		$token_dec = middleware::decode_token($token);
		if ($token_dec['exp'] < time()) {
			return "Wrong_User";
		}

		if (isset($_SESSION['username']) == $token_dec['username']) {
			return "Correct_User";
		} else {
			return "Wrong_User";
		}
	}
	public function get_recover_email_BBL($args) {

		$email = $this -> dao -> select_recover_password($this->db, $args);
		$token_email = common::generate_Token_secure(20);
		if (!empty($email)) {

			$this -> dao -> update_recover_password($this->db, $email[0]['email'], $token_email);

			$message = ['type' => 'recover', 
						'token' => $token_email, 
						'toEmail' => 'davidmpenades@gmail.com'];
						// 'toEmail' => $args]; //
			
			$email = json_decode(mail::send_email($message), true);
			if (!empty($email)) {
				return "ok";  
			}   
		}else{
			return 'error';
		}
	}
	public function get_verify_token_BLL($args) {

		if($this -> dao -> select_verify_email($this->db, $args)){
			return 'ok';
		}
		return 'fail';
	}
	public function get_new_password_BLL($args) {
		$hashed_pass = password_hash($args[1], PASSWORD_DEFAULT, ['cost' => 12]);
		if($this -> dao -> update_new_passwoord($this->db, $args[0], $hashed_pass)){
			return 'done';
		}
		return 'fail';
	}
	public function get_refresh_token_BLL($token)
	{
		$old_token = middleware::decode_token($token);
		if ($old_token) {
			$new_token = middleware::create_token($old_token['username']);
			return $new_token;
		} else {
			return 'error';
		}
	}
	public function get_refresh_cookie_BLL()
	{
		session_regenerate_id();
		return "Done";
	}
	public function get_social_login_BLL($args){
		$user = $this -> dao -> seleccionar_usuario($this->db, $args[1]);

		// $user = $this -> dao -> insert_user_social_login($this->db, $args[0], $args[1], $args[2], $args[3]);
		return $user;
		if (!empty($this -> dao -> seleccionar_usuario($this->db, $args[1]))) {
			$user = $this -> dao -> seleccionar_usuario($this->db, $args[1]);
			$new_token = middleware::create_token($user[0]);
			return $new_token;
		} 
		else {
			$user = $this -> dao -> insert_user_social_login($this->db, $args[0], $args[1], $args[2], $args[3]);
			$user = $this -> dao -> seleccionar_usuario($this->db, $args[1]);
			$new_token = middleware::create_token($user[0]);
			return $new_token;
		}
	}
	
}
