<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_pengurus extends CI_Controller
{
	protected $table = "presensi_pengurus";
	public function __construct()
	{
		parent::__construct();
		// additional library
		// $this->load->library('image_upload');
	}
	public function create()
	{
		// $upload = $this->image_upload->to('location', title);
		$data = array(
			"pengurus_nim" => post('pengurus_nim'),
			"agenda_id" => post('agenda_id'),
		);
		$check = $this->data_model->select_one($this->table, $data);
		if (!$check->error)
			error("pengguna sudah melakukan presensi");
		$do = $this->data_model->insert($this->table, $data);
		if (!$do->error) {
			success("data berhasil ditambahkan", $do->data);
		} else {
			error("data gagal ditambahkan");
		}
	}

	// public function get($id = null)
	// {
	// 	if ($id == null) {
	// 		$do = $this->data_model->select($this->table);
	// 	} else {
	// 		$do = $this->data_model->select_one($this->table, array("id" => $id));
	// 	}

	// 	if (!$do->error) {
	// 		success("data berhasil ditemukan", $do->data);
	// 	} else {
	// 		error("data gagal ditemukan");
	// 	}
	// }

	// public function update()
	// {
	// 	$data = array(
	// 		"pengurus_nim" => post('pengurus_nim'),
	// 		"agenda_id" => post('agenda_id'),
	// 	);

	// 	$where = array(
	// 		"id" => post('id'),
	// 	);

	// 	$do = $this->data_model->update($this->table, $where, $data);
	// 	if (!$do->error) {
	// 		success("data berhasil diubah", $do->data);
	// 	} else {
	// 		error("data gagal diubah");
	// 	}
	// }

	public function delete()
	{
		$where = array(
			"pengurus_nim" => post('nim'),
			"agenda_id" => post('agenda_id'),
		);

		$do = $this->data_model->delete($this->table, $where);
		if (!$do->error) {
			success("data berhasil dihapus", $do->data);
		} else {
			error("data gagal dihapus");
		}
	}
}
