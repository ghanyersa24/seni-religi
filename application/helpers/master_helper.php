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

function tgl($tgl)
{
	$check = strtotime($tgl);
	if ($check != false) {
		if ($check > strtotime(date("Y-m-d H:i:s")))
			return date("Y-m-d H:i", strtotime($tgl));
		else {
			error("tanggal sudah tidak bisa dipilih");
		}
	} else
		error("tanggal tidak sesuai dengan ketentuan");
}

// --------------- helper inputan

function post($params, $constrains = null)
{

	if (isset($_POST[$params])) {
		$value = $_POST[$params];
		if (!is_null($constrains)) {
			$constrains = explode('|', $constrains);
			foreach ($constrains as $check) {
				if ($check == 'is_email') {
					is_email($value);
				}
			}
		}
		return strip_tags(r($_POST[$params]));
	} else {
		error("data input $params kosong");
	}
}

function is_email($email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		error("inputan email tidak valid");
	}
}

function post_null($key)
{
	if (isset($_POST[$key])) {
		return strip_tags($_POST[$key]);
	} else {
		return "";
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
