<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_guest extends CI_Controller
{
	protected $table = "presensi_guest";
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
			"guest_id" => post('guest_id'),
			"agenda_id" => post('agenda_id'),
		);

		$do = $this->data_model->insert($this->table, $data);
		if (!$do->error) {
			success("data berhasil ditambahkan", $do->data);
		} else {
			error("data gagal ditambahkan");
		}
	}

	public function get($id = null, $params = null)
	{
		if ($params == 'guest') {
			$do = $this->data_model->select_where($this->table, array("guest_id" => $id));
		} else if ($params == 'agenda') {
			$do = $this->data_model->select_where($this->table, array("agenda_id" => $id));
		} else {
			$do = $this->data_model->select($this->table);
		}
		if (!$do->error) {
			success("data berhasil ditemukan", $do->data);
		} else {
			error("data gagal ditemukan");
		}
	}

	// public function update()
	// {
	// 	$data = array(
	// "guest_id" => post('guest_id'),
	// "agenda_id" => post('agenda_id'),
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
			"id" => post('id')
		);

		$do = $this->data_model->delete($this->table, $where);
		if (!$do->error) {
			success("data berhasil dihapus", $do->data);
		} else {
			error("data gagal dihapus");
		}
	}
}
