<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
	protected $table = "agenda";
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
			"agenda_category_id" => post('agenda_category'),
			"title" => post('title'),
			"location" => post('location'),
			"start_at" => post('mulai', 'date_now'),
			"end_at" => post('selesai', 'date_now|greater:mulai'),
		);
		$do = $this->data_model->insert($this->table, $data);
		if (!$do->error) {
			success("data berhasil ditambahkan", $do->data);
		} else {
			error("data gagal ditambahkan");
		}
	}
	public function recent()
	{
		$do = $this->data_custom->recent_agenda();
		if (!$do->error) {
			$temp = array();
			foreach ($do->data as $data) {
				$now = date("Y-m-d H:i:s");
				if ($data->start_at < $now && $now < $data->end_at)
					$data->status = 'on going';
				else if ($data->start_at > $now)
					$data->status = 'soon';
				else if ($now > $data->end_at)
					$data->status = 'finish';
				$data->waktu_mulai = tgl_indo($data->start_at);
				$data->waktu_selesai = tgl_indo($data->end_at);

				array_push($temp, $data);
			}
			success("data berhasil ditemukan", $temp);
		} else {
			error("data gagal ditemukan");
		}
	}
	public function get($id = null)
	{
		if ($id == null) {
			$do = $this->data_custom->all_agenda($this->table);
		} else {
			$do = $this->data_custom->detail_agenda(array("agenda.id" => $id));
		}

		if (!$do->error) {
			$temp = array();
			foreach ($do->data as $data) {
				$now = date("Y-m-d H:i:s");
				if ($data->start_at < $now && $now < $data->end_at)
					$data->status = 'on going';
				else if ($data->start_at > $now)
					$data->status = 'soon';
				else if ($now > $data->end_at)
					$data->status = 'finish';
				$data->waktu_mulai = tgl_indo($data->start_at);
				$data->waktu_selesai = tgl_indo($data->end_at);
				array_push($temp, $data);
			}
			success("data berhasil ditemukan", $temp);
		} else {
			error("data gagal ditemukan");
		}
	}

	public function update()
	{
		$data = array(
			"pengurus_nim" => post('pengurus_nim'),
			"agenda_category_id" => post('agenda_category'),
			"title" => post('title'),
			"location" => post('location'),
			"start_at" => post('start_at', 'date_now'),
			"end_at" => post('end_at', 'date_now'),
		);

		$where = array(
			"id" => post('id'),
		);

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
