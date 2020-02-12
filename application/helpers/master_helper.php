<?php
defined('BASEPATH') or exit('No direct script access allowed');

function r($value)
{
	$search = array("'", '"');
	$replace = array(" ");
	if (is_null($value)) {
		return "";
	}
	return str_replace($search, $replace, $value);
}

// --------------- helper tanggal
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>
		'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agt',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$tgl = date('d-m-Y', strtotime($tanggal));
	$pecahkan = explode('-', $tgl);
	$waktu = array(
		'tanggal' => $pecahkan[2],
		'bulan' => $bulan[(int) $pecahkan[1]],
		'tahun' => $pecahkan[0],
		'jam' => date('H:i', strtotime($tanggal))
	);
	return $waktu;
}
function date_valid($params, $value)
{
	$check = strtotime($value);
	if ($check != false) {
		return date("Y-m-d H:i:s", strtotime($value));
	} else
		error("$params tidak sesuai dengan ketentuan dd-mm-YYYY atau YYYY-mm-dd");
}

function date_now($params, $value)
{
	$check = strtotime($value);
	if ($check != false) {
		if ($check > strtotime(date("Y-m-d")))
			return date("Y-m-d H:i", strtotime($value));
		else {
			error("waktu $params tidak bisa menggunakan waktu lampau");
		}
	} else
		error("$params tidak sesuai dengan ketentuan dd-mm-YYYY atau YYYY-mm-dd");
}

// --------------- helper inputan
function post($params, $constrains = null)
{

	if (isset($_POST[$params]) && $_POST[$params] !== "") {
		$value = strip_tags(r($_POST[$params]));
		if (!is_null($constrains)) {
			$constrains = explode('|', $constrains);
			foreach ($constrains as $method) {
				if (strpos($method, ':')) {
					$tmp = explode('->', $method);
					$tmp[0]($params, $value, $tmp[1]);
				} else
					$method($params, $value);
			}
		}
		return $value;
	} else {
		error("data input $params tidak boleh kosong");
	}
}

function post_null($params, $constrains = null)
{
	if (isset($_POST[$params]) && $_POST[$params] !== "") {
		$value = strip_tags(r($_POST[$params]));
		if (!is_null($constrains)) {
			$constrains = explode('|', $constrains);
			foreach ($constrains as $method) {
				if (strpos($method, ':')) {
					$tmp = explode(':', $method);
					$tmp[0]($params, $value, $tmp[1]);
				} else
					$method($params, $value);
			}
		}
		return $value;
	} else {
		return "";
	}
}
function max_char($params, $value, $length)
{
	if (strlen($value) > $length) {
		error("$params lebih dari $length karakter");
	}
}


function min_char($params, $value, $length)
{
	if (strlen($value) < $length) {
		error("$params kurang dari $length karakter");
	}
}

function is_email($params, $value)
{
	if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
		error("$params tidak valid sebagai email");
	}
}
// --------------- helper message json
function success($msg, $data)
{
	header('Content-Type: application/json');
	echo json_encode(
		array(
			"error" => false,
			"message" => $msg,
			"data" => $data
		)
	);
	exit;
}

function error($msg)
{
	header('Content-Type: application/json');
	echo json_encode(
		array(
			"error" => true,
			"message" => $msg,
			"data" => []
		)
	);
	exit;
}

// --------------- helper model
function true($data)
{
	return (object) array(
		"error" => false,
		"data" => $data
	);
}

function false()
{
	return (object) array(
		"error" => true
	);
}
