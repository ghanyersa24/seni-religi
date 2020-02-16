<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function pengurus()
	{
		$username = post('nim');
		$do = $this->data_custom->login(array('nim' => $username));
		if ($do->error) {
			error("username and password isn't match");
		} else {
			if (password_verify(post("password"), $do->data->password))
				success("waiting a minute ...", $do->data);
			else
				error("username and password isn't match");
		}
	}
}
