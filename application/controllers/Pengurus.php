<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
	protected $table = "pengurus";
	public function __construct()
	{
		parent::__construct();
		// additional library
		$this->load->library('image_upload');
	}
	public function create()
	{
		if (post('role') !== 'PH' && post('role') !== 'ANGGOTA')
			error(post('role') . ' bukan role dalam sistem');
		// $upload = $this->image_upload->to('profil', 'profil-'.post('nim'));
		$data = array(
			"nim" => post('nim'),
			"bidang_id" => post('bidang_id'),
			"password" =>  password_hash(post('password'), PASSWORD_DEFAULT, array('cost' => 10)),
			"name" => post('name'),
			"jenis_kelamin" => post('jenis_kelamin'),
			"birthday_date" => post('birthday'),
			"faculty" => post('faculty'),
			"study_program" => post('study_program'),
			"ROLE" => post('role'),
			// "picture" => $upload,
		);
		$nim = $this->data_model->select_one($this->table, array('nim' => post('nim')));
		if (!$nim->error) {
			error("nim sudah terdaftar");
		} else {
			$do = $this->data_model->insert($this->table, $data);
			if (!$do->error) {
				success("data berhasil ditambahkan", $do->data);
			} else {
				error("data gagal ditambahkan");
			}
		}
	}

	public function get($id = null)
	{
		if ($id == null) {
			$do = $this->data_model->select($this->table);
		} else {
			$do = $this->data_model->select_one($this->table, array("nim" => $id));
		}

		if (!$do->error) {
			success("data berhasil ditemukan", $do->data);
		} else {
			error("data gagal ditemukan");
		}
	}

	public function update()
	{
		$data = array(
			"bidang_id" => post('bidang_id'),
			"name" => post('name'),
			"jenis_kelamin" => post('jenis_kelamin'),
			"birthday_date" => post('birthday'),
			"faculty" => post('faculty'),
			"study_program" => post('study_program'),
		);
		if (!empty($_FILES['picture'])) {
			$upload = $this->image_upload->to('profil', 'profil-' . post('nim'));
			$data['picture'] = $upload;
		}

		$where = array(
			"nim" => post('nim'),
		);

		$do = $this->data_model->update($this->table, $where, $data);
		if (!$do->error) {
			success("data berhasil diubah", $do->data);
		} else {
			error("data gagal diubah");
		}
	}
	public function update_password()
	{
		$where = array(
			"nim" => post('nim'),
		);
		$new_password = post("new_password");
		$confirm_password = post("confirmation_password", "same:new_password");

		$do = $this->data_custom->login($where);
		if ($do->error) {
			error("ada yang salah dengan akun kamu.");
		} else {
			if (password_verify(post("password"), $do->data->password)) {
				$data = array(
					'nim' => $do->data->nim,
					'password' => password_hash($new_password, PASSWORD_DEFAULT, array('cost' => 10))
				);

				$do = $this->data_model->update($this->table, $where, $data);
				if (!$do->error) {
					success("password berhasil diubah", $do->data);
				} else {
					error("password gagal diubah");
				}
			} else
				error("password lama salah.");
		}
	}

	public function delete()
	{
		$where = array(
			"nim" => post('nim')
		);

		$do = $this->data_model->delete($this->table, $where);
		if (!$do->error) {
			success("data berhasil dihapus", $do->data);
		} else {
			error("data gagal dihapus");
		}
	}
}
