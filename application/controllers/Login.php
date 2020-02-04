<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function customer()
	{
		$username=post('username');
		$do = $this->data_custom->login_customer($username);
		if (is_null($do->data)) {
			error("username and password isn't match");
		} else {
			if (password_verify(post("password"), $do->data->password))
				if ($do->data->status == 'activated') {
					success("waiting a minute ...", $do->data);
				} else
					error("sorry, this account isn't activate");
			else
				error("username and password isn't match");
		}
	}
	
	public function admin()
	{
		$do = $this->data_model->select_one('zero', array('username' => post('username')));
		if (is_null($do->data)) {
			error("username and password isn't match");
		} else {
			if (password_verify(post("password"), $do->data->password))
				if ($do->data->status == 'activated') {
					success("waiting a minute ...", $do->data);
				} else
					error("sorry, this account isn't activate");
			else
				error("username and password isn't match");
		}
	}
}
