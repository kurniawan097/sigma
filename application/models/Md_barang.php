<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Md_barang extends CI_Model
{
    //Kategori Barang
    function getAllKategori(){
        
        $this->db->order_by('name', 'ASC');
        return $this->datatables
        ->select('  
            id,
            name

        ')
        ->from('categories')
        ->generate();        
    }

    function addKategori($data)
    {
        $this->db->insert('categories', $data);
    }

    function updateKategori($where, $data)
    {
        $this->db->where($where);
        $this->db->update('categories', $data);
    }

    function getByIdKategori($id)
    {
        return $this->db->get_where('categories c', array('c.id' => $id))->result();
    }

    function deleteKategori($id)
    {
        $this->db->where('id', $id); 
        return $this->db->delete('categories');
    }

    function getListKategori()
	{
		$sql = 'SELECT * FROM categories c ORDER BY c.name ASC';
		$query = $this->db->query($sql);
		return $query->result(); 
	}


    //Data Barang
    function getAllBarang()
    {
        $this->db->order_by('p.name', 'ASC');
        return $this->datatables
            ->select('
                p.id,
                c.name AS category_name,
                p.name,
                p.code,
                p.unit,
                p.stock
            ')
            ->from('products p')
            ->join('categories c', 'c.id = p.categories_id', 'left')
            ->generate();
    }

    function getByIdBarang($id)
    {
        return $this->db->get_where('products c', array('c.id' => $id))->result();
    }

    function addBarang($data)
    {
        $this->db->insert('products', $data);
    }

    function updateBarang($where, $data)
    {
        $this->db->where($where);
        $this->db->update('products', $data);
    }

    function deleteBarang($id)
    {
        $this->db->where('id', $id); 
        return $this->db->delete('products');
    }


    function getListBarang()
	{
		$sql = 'SELECT * FROM products c ORDER BY c.name ASC';
		$query = $this->db->query($sql);
		return $query->result(); 
	}  

    function getAllProducts()
    {
        return $this->db->select('id, name')->get('products')->result();
    }

    function getBarangByCode($code, $exclude_id = null)
    {
        $this->db->where('code', $code);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get('products')->row();
    }



    //Stok
    function getProductById($id)
    {
        return $this->db->where('id', $id)->get('products')->row();
    }

    function updateStock($id, $newStock)
    {
        return $this->db->where('id', $id)->update('products', ['stock' => $newStock]);
    }


    //Pembelian (Pemasukan Barang)
    function addPembelian($data)
    {
        $this->db->insert('pembelian', $data);
        return $this->db->insert_id();
    }

    function addIncoming($data)
    {
        $this->db->insert('incoming_items', $data);
    }

    function getAllPembelian()
    {
        $this->db->order_by('p.created_at', 'DESC');
        return $this->datatables
            ->select('
                p.id,
                p.nama_vendor,
                p.alamat_vendor,
                p.tanggal,
                p.nama_pembeli,
                GROUP_CONCAT(pr.name SEPARATOR ", ") as name_product
            ')
            ->from('pembelian p')
            ->join('incoming_items ii', 'ii.pembelian_id = p.id', 'left')
            ->join('products pr', 'pr.id = ii.product_id', 'left')
            ->group_by('p.id') 
            ->generate();
    }

    function getIncomingByPembelian($id)
    {
        return $this->db->where('pembelian_id', $id)->get('incoming_items')->result();
    }

    function deleteIncomingByPembelian($id)
    {
        return $this->db->where('pembelian_id', $id)->delete('incoming_items');
    }

    function getPembelianById($id)
    {
        return $this->db->where('id', $id)->get('pembelian')->row();
    }

    function getDetailPembelian($pembelian_id)
    {
        return $this->db
            ->select('ii.id, ii.product_id, ii.quantity, p.name as product_name')
            ->from('incoming_items ii')
            ->join('products p', 'p.id = ii.product_id')
            ->where('ii.pembelian_id', $pembelian_id)
            ->get()
            ->result();
    }

    function updatePembelian($id, $data)
    {
        return $this->db->where('id', $id)->update('pembelian', $data);
    }

    function deletePembelian($id)
    {
        return $this->db->where('id', $id)->delete('pembelian');
    }


    //Penjualan (pengeluaran Barang)
    function addPenjualan($data)
    {
        $this->db->insert('penjualan', $data);
        return $this->db->insert_id();
    }

    function addOutgoing($data)
    {
        $this->db->insert('outgoing_items', $data);
    }

    function getAllPenjualan()
    {
        $this->db->order_by('p.created_at', 'DESC');
        return $this->datatables
            ->select('
                p.id,
                p.nama_vendor,
                p.alamat_vendor,
                p.tanggal,
                p.nama_penjual,
                GROUP_CONCAT(pr.name SEPARATOR ", ") as name_product
            ')
            ->from('penjualan p')
            ->join('outgoing_items oi', 'oi.penjualan_id = p.id', 'left')
            ->join('products pr', 'pr.id = oi.product_id', 'left')
            ->group_by('p.id') 
            ->generate();
    }

    function getOutgoingByPenjualan($id)
    {
        return $this->db->where('penjualan_id', $id)->get('outgoing_items')->result();
    }

    function deleteOutgoingByPenjualan($id)
    {
        return $this->db->where('penjualan_id', $id)->delete('outgoing_items');
    }

    function getPenjualanById($id)
    {
        return $this->db->where('id', $id)->get('penjualan')->row();
    }

    function getDetailPenjualan($penjualan_id)
    {
        return $this->db
            ->select('oi.id, oi.product_id, oi.quantity, p.name as product_name')
            ->from('outgoing_items oi')
            ->join('products p', 'p.id = oi.product_id')
            ->where('oi.penjualan_id', $penjualan_id)
            ->get()
            ->result();
    }

    function updatePenjualan($id, $data)
    {
        return $this->db->where('id', $id)->update('penjualan', $data);
    }

    function deletePenjualan($id)
    {
        return $this->db->where('id', $id)->delete('penjualan');
    }


    //Laporan
    function getAllMasukByTGL($tglawal, $tglakhir)
    {
        $this->db->order_by('i.date', 'DESC');

        $query = $this->db
            ->select('
                i.id,
                i.pembelian_id,
                i.product_id,
                p.name as product_name,
                i.date,
                i.quantity
            ')
            ->from('incoming_items i')
            ->join('products p', 'p.id = i.product_id', 'left')
            ->where('i.date >=', date('Y-m-d', strtotime($tglawal)))
            ->where('i.date <=', date('Y-m-d', strtotime($tglakhir)));

        return $query->get()->result();
    }


    function getAllKeluarByTGL($tglawal, $tglakhir)
    {
        $this->db->order_by('i.date', 'DESC');

        $query = $this->db
            ->select('
                i.id,
                i.penjualan_id,
                i.product_id,
                p.name as product_name,
                i.date,
                i.quantity
            ')
            ->from('outgoing_items i')
            ->join('products p', 'p.id = i.product_id', 'left')
            ->where('i.date >=', date('Y-m-d', strtotime($tglawal)))
            ->where('i.date <=', date('Y-m-d', strtotime($tglakhir)));

        return $query->get()->result();
    }

    function getAllStock()
    {
        $this->db->order_by('p.name', 'ASC'); 

        $query = $this->db
            ->select('
                p.id,
                p.name as product_name,
                p.code,
                p.unit,
                p.stock,
                c.id as category_id,
                c.name as category_name,
                c.created_at as category_created_at
            ')
            ->from('products p')
            ->join('categories c', 'c.id = p.categories_id', 'left');

        return $query->get()->result();
    }


    //Dashboard
    function countBarang()
    {
        return $this->db->count_all('products');
    }

    function countMasuk()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(date)', $today);
        return $this->db->count_all_results('incoming_items');
    }

    function countKeluar()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(date)', $today);
        return $this->db->count_all_results('outgoing_items');
    }

    function countKategori()
    {
        return $this->db->count_all('categories');
    }

    function countPembelian()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(tanggal)', $today);
        return $this->db->count_all_results('pembelian');
    }

    function countPenjualan()
    {
        $today = date('Y-m-d');
        $this->db->where('DATE(tanggal)', $today);
        return $this->db->count_all_results('penjualan');
    }




}
