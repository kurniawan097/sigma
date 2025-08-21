<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('md_barang');
        $this->load->model('md_log');
    }
	
	function id_navbar(){
		$id_navbar = "home";
		return $id_navbar;
	}

    public function index()
    {
        grantAccessFor('all');
		
		$page_data['switch']      	= $this->id_navbar();
        $page_data['page_name']		= 'dashboard';
        $page_data['page_title']    = 'Dashboard';
        $page_data['total_barang'] 	= $this->md_barang->countBarang();
        $page_data['masuk'] 	    = $this->md_barang->countMasuk();
        $page_data['keluar'] 	    = $this->md_barang->countKeluar();
        $page_data['kategori'] 	    = $this->md_barang->countKategori();
        $page_data['pembelian'] 	= $this->md_barang->countPembelian();
        $page_data['penjualan'] 	= $this->md_barang->countPenjualan();
        $this->load->view('index', $page_data);
    }

    public function pagination_log()
    {
        grantAccessFor('all');

        $dt = $this->md_log->getAllLog();
        $start = $this->input->post('start');
        $data = array();
        foreach ($dt['data'] as $row) {
            $th = array();
            $th[] = ++$start . '.';
            $th[] = $row->nama_pengguna ? $row->nama_pengguna : '-';
            $th[] = $row->jenis_aksi;
            $th[] = $row->keterangan;
            $th[] = '<i class="fa fa-clock-o"></i> ' . date('d-M-Y | H:i', strtotime($row->tgl));
            $data[] = $th;
        }
        $dt['data'] = $data;
        echo json_encode($dt);
        die;
    }
}
