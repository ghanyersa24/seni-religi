<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Db_custom extends CI_Model
{
    public function login_customer($username)
    {
        $query = $this->db
            ->select('*')
            ->from('customer')
            ->where("username =", $username)
            ->or_where("email =", $username)
            ->get();
        if ($query) {
            return true($query->row());
        } else {
            return false();
        }
    }
}
