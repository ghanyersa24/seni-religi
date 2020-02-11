<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Db_custom extends CI_Model
{
	public function report_pengurus($user)
	{
		$this->db
			->select("concat((select COUNT(presensi_pengurus.pengurus_nim) from presensi_pengurus join agenda a on presensi_pengurus.agenda_id=a.id where a.agenda_category_id=agenda_category.id and presensi_pengurus.pengurus_nim=" . $user->nim . ") ,'/',COUNT(agenda_category.id)) as kehadiran,agenda_category.name as kategori")
			->from('agenda')
			->join('agenda_category', 'agenda.agenda_category_id=agenda_category.id', 'left')
			->where(array('agenda.created_at >' => $user->created_at))
			->group_by('agenda_category.id');
		if ($user->role == 'PH')
			$query = $this->db->where_in('agenda.agenda_category_id', array('1', '2', '3', '4', '5', '6'))->get();
		else if ($user->role == 'ANGGOTA')
			$query = $this->db->where_in('agenda.agenda_category_id', array('1', '2', '3', '4', '6'))->get();

		if ($query) {
			return true($query->result());
		} else {
			return false();
		}
	}

	public function report_guest($user)
	{
		$query = $this->db
			->select("concat((select COUNT(presensi_guest.guest_id) from presensi_guest join agenda a on presensi_guest.agenda_id=a.id where a.agenda_category_id=agenda_category.id and presensi_guest.guest_id=" . $user->id . ") ,'/',COUNT(agenda_category.id)) as kehadiran,agenda_category.name as kategori")
			->from('agenda')
			->join('agenda_category', 'agenda.agenda_category_id=agenda_category.id', 'left')
			->where(array('agenda.created_at >' => $user->created_at))
			->where_in('agenda_category.id', array(1, 2, 4))
			->group_by('agenda_category.id')
			->get();

		if ($query) {
			return true($query->result());
		} else {
			return false();
		}
	}

	public function report_agenda($id)
	{
		$query = $this->db
			->select('nim, name, faculty, study_program, role, presensi_pengurus.created_at as kehadiran')
			->from('presensi_pengurus')
			->join('pengurus', 'presensi_pengurus.pengurus_nim=pengurus.nim')
			->where("agenda_id = $id UNION (select guest.id,name, 'seni-religi','seni-religi', 'TAMU', presensi_guest.created_at as kehadiran from presensi_guest join guest on guest.id=presensi_guest.guest_id where presensi_guest.agenda_id=$id)")
			->get();

		if ($query) {
			return true($query->result());
		} else {
			return false();
		}
	}
}
