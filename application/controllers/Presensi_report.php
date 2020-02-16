<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Presensi Report
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Presensi_report extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get($id = null, $params = null)
	{
		if ($params == 'nim') {
			$user = $this->data_model->select_one('pengurus', array('nim' => $id));
			if ($user->error)
				error("data pengguna tidak ditemukan");
			$do = $this->data_custom->report_pengurus($user->data);
			$do->data = $this->parse_decimal($do->data);
		} else if ($params == 'guest') {
			$user = $this->data_model->select_one('guest', array('id' => $id));
			if ($user->error)
				error("data pengguna tidak ditemukan");
			$do = $this->data_custom->report_guest($user->data);
			$do->data = $this->parse_decimal($do->data);
		} else if ($params == 'agenda') {
			$agenda = $this->data_model->select_where('agenda', array('id' => $id));
			if ($agenda->error)
				error('agenda tidak ditemukan');
			$do = $this->data_custom->report_agenda($id);
			$guest = $this->data_custom->report_agenda_guest($id);
			$do->data = array('agenda' => $agenda->data, 'presensi' => array('pengurus' => $do->data, 'guest' => $guest->data));
		} else {
			$do->error = true;
		}
		if (!$do->error) {
			success("data berhasil ditemukan", $do->data);
		} else {
			error("data gagal ditemukan");
		}
	}
	private function parse_decimal($value)
	{
		foreach ($value as $val) {
			$data = explode('/', $val->kehadiran);
			$val->persentase = (float) $data[0] / $data[1];
		}
		return $value;
	}
}


/* End of file Presensi Report.php */
/* Location: ./application/controllers/Presensi Report.php */
