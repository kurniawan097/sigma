<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Md_pengguna extends CI_Model
{
    function getBywhere($where)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by('p.nama', 'ASC');
        return $this->db->get('pengguna p')->result();
    }

}
