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
			error(post('role').' bukan role dalam sistem');
		$upload = $this->image_upload->to('profil', 'profil-'.post('nim'));
		$data = array(
			"nim" => post('nim'),
			"bidang_id" => post('bidang_id'),
			"password" =>  password_hash(post('password'), PASSWORD_DEFAULT, array('cost' => 10)),
			"name" => post('name'),
			"birthday_date" => post('birthday'),
			"faculty" => post('faculty'),
			"study_program" => post('study_program'),
			"ROLE" => post('role'),
			"picture" => $upload,
		);
		$nim = $this->data_model->select_where($this->table, array('nim' => post('nim')));
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

	private function pass_is_same($where, $pass)
	{
		$do = $this->data_model->select_one($this->table, $where);
		if (!$do->error) {
			if ($pass == $do->data->password) {
				return true;
			} else {
				return false;
			}
		} else {
			error("data password gagal ditemukan");
		}
	}
	public function update()
	{
		if (post('role') != 'PH' && post('role') != 'ANGGOTA')
			error("role harus sesuai ketentuan");
		$data = array(
			"bidang_id" => post('bidang_id'),
			"name" => post('name'),
			"birthday_date" => post('birthday'),
			"faculty" => post('faculty'),
			"study_program" => post('study_program'),
			"ROLE" => post('role'),
		);

		$where = array(
			"nim" => post('nim'),
		);

		if ($this->pass_is_same($where, post('password')) == false) {
			$data['password'] = password_hash(post('password'), PASSWORD_DEFAULT, array('cost' => 10));
		}

		if (!empty($_FILES['name'])) {
			$upload = $this->image_upload->to('profil', 'title');
			$data['picture'] = $upload;
		}

		$do = $this->data_model->update($this->table, $where, $data);
		if (!$do->error) {
			success("data berhasil diubah", $do->data);
		} else {
			error("data gagal diubah");
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
