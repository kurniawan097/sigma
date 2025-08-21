<?php

use FontLib\Table\Type\post;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('md_barang');
    }
	
	function id_navbar(){
		$id_navbar = "home";
		return $id_navbar;
	}


    public function show($param = "", $param2 = "", $param3 = "")
    {
        grantAccessFor('all');
        if ($param == 'kategori') {
			$page_data['switch']      		= $this->id_navbar();
            $page_data['page_name']         = 'barang/v_kategori_barang';
            $page_data['page_title']        = 'Kategori Barang';
            $page_data['page_desc']         = 'Manajemen Kategori Barang';
            $this->load->view('index', $page_data);
        }else if ($param == 'barang') {
			$page_data['switch']      		= $this->id_navbar();
            $page_data['list_kategori']     = $this->md_barang->getListKategori();
            $page_data['page_name']         = 'barang/v_barang';
            $page_data['page_title']        = 'Data Barang';
            $page_data['page_desc']         = 'Manajemen Data Barang';
            $this->load->view('index', $page_data);			
        }else if ($param == 'pembelian') {
			$page_data['switch']      		= $this->id_navbar();
            $page_data['list_barang']       = $this->md_barang->getListBarang();
            $page_data['page_name']         = 'barang/v_pembelian';
            $page_data['page_title']        = 'Data Pembelian';
            $page_data['page_desc']         = 'Manajemen Data Pembelian / Barang Masuk';
            $this->load->view('index', $page_data);			
        }else if ($param == 'penjualan') {
			$page_data['switch']      		= $this->id_navbar();
            $page_data['list_barang']       = $this->md_barang->getListBarang();
            $page_data['page_name']         = 'barang/v_penjualan';
            $page_data['page_title']        = 'Data Penjualan';
            $page_data['page_desc']         = 'Manajemen Data Penjualan / Barang Keluar';
            $this->load->view('index', $page_data);			
        }


    }


    public function pagination($param = "")
    {
        grantAccessFor('all');

        if ($param == 'kategori') {
            $dt    = $this->md_barang->getAllKategori();
            $start = $this->input->post('start');

            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = encrypt($row->id);
                $li_btn   = '
                    <div class="btn-group" role="group" aria-label="First group">
                        <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="' . $id . '"><i class="bx bx-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Data" data-id="' . $id . '" data-object="barang/deleteKategori"><i class="bx bx-trash"></i></button>
                    </div>';
                $th = array();
                $th[] = ++$start . '.';
                $th[] = $row->name;
                $th[] = $li_btn;
                $data[] = $th;
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        }else if ($param == 'barang') {
            $dt    = $this->md_barang->getAllBarang();
            $start = $this->input->post('start');

            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = encrypt($row->id);
                $li_btn   = '
                    <div class="btn-group" role="group" aria-label="First group">
                        <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="' . $id . '"><i class="bx bx-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Data" data-id="' . $id . '" data-object="barang/deleteBarang"><i class="bx bx-trash"></i></button>
                    </div>';
                $th = array();
                $th[] = ++$start . '.';
                $th[] = $row->category_name;
                $th[] = $row->name;
                $th[] = $row->code;
                $th[] = $row->unit;
                $th[] = $row->stock;
                $th[] = $li_btn;
                $data[] = $th;
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        }else if ($param == 'pembelian') {
            $dt    = $this->md_barang->getAllPembelian();
            $start = $this->input->post('start');

            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = encrypt($row->id);
                $li_btn   = '
                    <div class="btn-group" role="group" aria-label="First group">
                        <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="' . $id . '"><i class="bx bx-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Data" data-id="' . $id . '" data-object="barang/deletePembelian"><i class="bx bx-trash"></i></button>
                    </div>';
                $th = array();
                $th[] = ++$start . '.';
                $th[] = $row->nama_vendor;
                $th[] = $row->alamat_vendor;
                $th[] = date('d-M-Y',strtotime($row->tanggal));
                $th[] = $row->nama_pembeli;
                $th[] = $row->name_product;
                $th[] = $li_btn;
                $data[] = $th;
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        }else if ($param == 'penjualan') {
            $dt    = $this->md_barang->getAllPenjualan();
            $start = $this->input->post('start');

            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = encrypt($row->id);
                $li_btn   = '
                    <div class="btn-group" role="group" aria-label="First group">
                        <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="' . $id . '"><i class="bx bx-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus Data" data-id="' . $id . '" data-object="barang/deletePenjualan"><i class="bx bx-trash"></i></button>
                    </div>';
                $th = array();
                $th[] = ++$start . '.';
                $th[] = $row->nama_vendor;
                $th[] = $row->alamat_vendor;
                $th[] = date('d-M-Y',strtotime($row->tanggal));
                $th[] = $row->nama_penjual;
                $th[] = $row->name_product;
                $th[] = $li_btn;
                $data[] = $th;
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        }

    }

    public function add($param = "")
    {
        grantAccessFor('all');
        if ($param == 'kategori') {

            $data['name'] = $this->input->post('nama_kategori');

            $this->md_barang->addKategori($data);

            $aksi = 'Tambah Master Data';
            $ket = 'Menambahkan data Kategori Barang - ' . $data['name'];
            addlog($aksi, $ket);
            ajaxReturnDie('success', 'Data Berhasil Ditambahkan', TRUE);

        }else if ($param == 'barang') {

            $code = $this->input->post('code', TRUE);
            
            $existing = $this->md_barang->getBarangByCode($code);
            if ($existing) {
                ajaxReturnDie('error', 'Kode barang "' . $code . '" sudah digunakan.', FALSE);
            }
            
            $data['categories_id'] = $this->input->post('id_kategori', TRUE);
            $data['name']          = $this->input->post('nama_barang', TRUE);
            $data['code']          = $code;
            $data['unit']          = $this->input->post('unit', TRUE);
            $data['stock']         = $this->input->post('stock', TRUE);

            $this->md_barang->addBarang($data);

            $aksi = 'Tambah Master Data';
            $ket  = 'Menambahkan data Barang - ' . $data['name'];
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data Berhasil Ditambahkan', TRUE);

        }else if ($param == 'pembelian') {
            
            $nama_vendor   = $this->input->post('nama_vendor', TRUE);
            $alamat_vendor = $this->input->post('alamat_vendor', TRUE);
            $tanggal       = $this->input->post('tanggal', TRUE);
            $nama_pembeli  = $this->input->post('nama_pembeli', TRUE);

            $id_barang     = $this->input->post('id_barang'); 
            $qty           = $this->input->post('qty');       

            if (empty($id_barang) || count($id_barang) == 0) {
                ajaxReturnDie('error', 'Minimal pilih 1 barang', FALSE);
            }

           
            $data_pembelian = [
                'nama_vendor'   => $nama_vendor,
                'alamat_vendor' => $alamat_vendor,
                'tanggal'       => date('Y-m-d', strtotime($tanggal)),
                'nama_pembeli'  => $nama_pembeli
            ];

            $pembelian_id = $this->md_barang->addPembelian($data_pembelian);

            $dateTime = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . date('H:i:s')));

            
            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];

                $detail = [
                    'pembelian_id' => $pembelian_id,
                    'product_id'   => $barang_id,
                    'date'         => $dateTime,
                    'quantity'     => $jumlah
                ];
                $this->md_barang->addIncoming($detail);

                $product = $this->md_barang->getProductById($barang_id); 
                if ($product) {
                    $stok_baru = $product->stock + $jumlah;
                    $this->md_barang->updateStock($barang_id, $stok_baru);
                }
            }

            $aksi = 'Tambah Pembelian';
            $ket  = 'Menambahkan data pembelian : ' . $nama_vendor;
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data pembelian berhasil disimpan', TRUE);


        }else if ($param == 'penjualan') {

            $nama_vendor   = $this->input->post('nama_vendor', TRUE);
            $alamat_vendor = $this->input->post('alamat_vendor', TRUE);
            $tanggal       = $this->input->post('tanggal', TRUE);
            $nama_penjual  = $this->input->post('nama_penjual', TRUE);

            $id_barang     = $this->input->post('id_barang'); 
            $qty           = $this->input->post('qty');       

            if (empty($id_barang) || count($id_barang) == 0) {
                ajaxReturnDie('error', 'Minimal pilih 1 barang', FALSE);
            }

           
            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];
                $product = $this->md_barang->getProductById($barang_id); 

                if (!$product) {
                    ajaxReturnDie('error', 'Produk ID ' . $barang_id . ' tidak ditemukan', FALSE);
                }

                if ($product->stock < $jumlah) {
                    ajaxReturnDie('error', 'Stok produk "' . $product->name . '" tidak mencukupi. Stok tersedia: ' . $product->stock, FALSE);
                }
            }

            $data_pembelian = [
                'nama_vendor'   => $nama_vendor,
                'alamat_vendor' => $alamat_vendor,
                'tanggal'       => date('Y-m-d', strtotime($tanggal)),
                'nama_penjual'  => $nama_penjual
            ];

            $penjualan_id = $this->md_barang->addPenjualan($data_pembelian);
            $dateTime = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . date('H:i:s')));

            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];
                $product = $this->md_barang->getProductById($barang_id);

                $detail = [
                    'penjualan_id' => $penjualan_id,
                    'product_id'   => $barang_id,
                    'date'         => $dateTime,
                    'quantity'     => $jumlah
                ];
                $this->md_barang->addOutgoing($detail);

                $stok_baru = $product->stock - $jumlah;
                $this->md_barang->updateStock($barang_id, $stok_baru);
            }

            $aksi = 'Tambah Penjualan';
            $ket  = 'Menambahkan data penjualan : ' . $nama_vendor;
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data penjualan berhasil disimpan', TRUE);


        }
    }

    public function editKategori($param1)
    {
        grantAccessFor('all');

        $id = decrypt($param1);
        $dt = $this->md_barang->getByIdKategori($id);
        foreach ($dt as $row) {
            $row->id = encrypt($row->id);
        }
        echo json_encode($dt);
        die;
    }

    public function editBarang($param1)
    {
        grantAccessFor('all');

        $id = decrypt($param1);
        $dt = $this->md_barang->getByIdBarang($id);
        foreach ($dt as $row) {
            $row->id = encrypt($row->id);
        }
        echo json_encode($dt);
        die;
    }


    public function editPembelian($param1)
    {

        $id = decrypt($param1);
        $pembelian = $this->md_barang->getPembelianById($id);
        $detail_barang = $this->md_barang->getDetailPembelian($id);
        $list_barang = $this->md_barang->getAllProducts(); 

        $result = [
            'pembelian' => $pembelian,
            'detail_barang' => $detail_barang,
            'list_barang' => $list_barang
        ];

        echo json_encode($result);
    }


    public function editPenjualan($param1)
    {
        $id = decrypt($param1);
        $penjualan = $this->md_barang->getPenjualanById($id);
        $detail_barang = $this->md_barang->getDetailPenjualan($id);
        $list_barang = $this->md_barang->getAllProducts();

        $result = [
            'penjualan'      => $penjualan,
            'detail_barang'  => $detail_barang,
            'list_barang'    => $list_barang
        ];

        echo json_encode($result);
    }





    public function update($param = "")
    {
        grantAccessFor('all');
        if ($param == 'kategori') {

            $id = decrypt($this->input->post('id_kategori'));
            $data['name'] = $this->input->post('nama_kategori');

            $this->md_barang->updateKategori(['id' => $id], $data);
            
            $temp = $this->md_barang->getByIdKategori($id);
            $aksi = 'Edit Master Data';
            $ket = 'Mengedit data kategori barang - ' . $temp[0]->name;
            addlog($aksi, $ket);
            ajaxReturnDie('success', 'Data berhasil diupdate', TRUE);
    
        }else if ($param == 'barang') {
            
           $id   = decrypt($this->input->post('id_barang'));
            $code = $this->input->post('code', TRUE);

            
            $existing = $this->md_barang->getBarangByCode($code, $id);
            if ($existing) {
                ajaxReturnDie('error', 'Kode barang "' . $code . '" sudah digunakan oleh barang lain.', FALSE);
            }

            
            $data['categories_id'] = $this->input->post('id_kategori', TRUE);
            $data['name']          = $this->input->post('nama_barang', TRUE);
            $data['code']          = $code;
            $data['unit']          = $this->input->post('unit', TRUE);
            $data['stock']         = $this->input->post('stock', TRUE);

            $this->md_barang->updateBarang(['id' => $id], $data);

            $temp = $this->md_barang->getByIdBarang($id);
            $aksi = 'Edit Master Data';
            $ket  = 'Mengedit data barang - ' . $temp[0]->name;
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data berhasil diupdate', TRUE);

        }else if ($param == 'pembelian') {
            
            $id_pembelian  = $this->input->post('id_pembelian', TRUE);
            $nama_vendor   = $this->input->post('nama_vendor', TRUE);
            $alamat_vendor = $this->input->post('alamat_vendor', TRUE);
            $tanggal       = $this->input->post('tanggal', TRUE);
            $nama_pembeli  = $this->input->post('nama_pembeli', TRUE);
            $id_barang     = $this->input->post('id_barang');
            $qty           = $this->input->post('qty');

            if (empty($id_barang) || count($id_barang) == 0) {
                ajaxReturnDie('error', 'Minimal pilih 1 barang', FALSE);
            }

            $oldItems = $this->md_barang->getIncomingByPembelian($id_pembelian);

            $data_pembelian = [
                'nama_vendor'   => $nama_vendor,
                'alamat_vendor' => $alamat_vendor,
                'tanggal'       => date('Y-m-d', strtotime($tanggal)),
                'nama_pembeli'  => $nama_pembeli
            ];
            $this->md_barang->updatePembelian($id_pembelian, $data_pembelian);

            foreach ($oldItems as $item) {
                $product = $this->md_barang->getProductById($item->product_id);
                if ($product) {
                    $stok_baru = $product->stock - $item->quantity;
                    $this->md_barang->updateStock($item->product_id, $stok_baru);
                }
            }

            $this->md_barang->deleteIncomingByPembelian($id_pembelian);

            $dateTime = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . date('H:i:s')));
            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];

                $detail = [
                    'pembelian_id' => $id_pembelian,
                    'product_id'   => $barang_id,
                    'date'         => $dateTime,
                    'quantity'     => $jumlah
                ];
                $this->md_barang->addIncoming($detail);

                $product = $this->md_barang->getProductById($barang_id);
                if ($product) {
                    $stok_baru = $product->stock + $jumlah;
                    $this->md_barang->updateStock($barang_id, $stok_baru);
                }
            }

            $aksi = 'Update Pembelian';
            $ket  = 'Mengupdate data pembelian : ' . $nama_vendor;
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data pembelian berhasil diperbarui', TRUE);

        }else if ($param == 'penjualan') {
            
            $id_penjualan  = $this->input->post('id_penjualan', TRUE);
            $nama_vendor   = $this->input->post('nama_vendor', TRUE);
            $alamat_vendor = $this->input->post('alamat_vendor', TRUE);
            $tanggal       = $this->input->post('tanggal', TRUE);
            $nama_penjual  = $this->input->post('nama_penjual', TRUE);
            $id_barang     = $this->input->post('id_barang');
            $qty           = $this->input->post('qty');

            
            if (empty($id_barang) || count($id_barang) == 0) {
                ajaxReturnDie('error', 'Minimal pilih 1 barang', FALSE);
            }
            $oldItems = $this->md_barang->getOutgoingByPenjualan($id_penjualan);
            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];
                $product = $this->md_barang->getProductById($barang_id); 

                if (!$product) {
                    ajaxReturnDie('error', 'Produk ID ' . $barang_id . ' tidak ditemukan', FALSE);
                }

                $oldItem = null;
                foreach ($oldItems as $oi) {
                    if ($oi->product_id == $barang_id) {
                        $oldItem = $oi;
                        break;
                    }
                }
                $stok_tersedia = $product->stock + ($oldItem ? $oldItem->quantity : 0);

                if ($stok_tersedia < $jumlah) {
                    ajaxReturnDie('error', 'Stok produk "' . $product->name . '" tidak mencukupi. Stok tersedia: ' . $stok_tersedia, FALSE);
                }
            }

            

            $data_penjualan = [
                'nama_vendor'   => $nama_vendor,
                'alamat_vendor' => $alamat_vendor,
                'tanggal'       => date('Y-m-d', strtotime($tanggal)),
                'nama_penjual'  => $nama_penjual
            ];
            $this->md_barang->updatePenjualan($id_penjualan, $data_penjualan);

            
            foreach ($oldItems as $item) {
                $product = $this->md_barang->getProductById($item->product_id);
                if ($product) {
                    $stok_baru = $product->stock + $item->quantity;
                    $this->md_barang->updateStock($item->product_id, $stok_baru);
                }
            }

            $this->md_barang->deleteOutgoingByPenjualan($id_penjualan);

            $dateTime = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . date('H:i:s')));
            foreach ($id_barang as $key => $barang_id) {
                $jumlah = (int)$qty[$key];
                $product = $this->md_barang->getProductById($barang_id);

                $detail = [
                    'penjualan_id' => $id_penjualan,
                    'product_id'   => $barang_id,
                    'date'         => $dateTime,
                    'quantity'     => $jumlah
                ];
                $this->md_barang->addOutgoing($detail);

                $stok_baru = $product->stock - $jumlah;
                $this->md_barang->updateStock($barang_id, $stok_baru);
            }

            $aksi = 'Update Penjualan';
            $ket  = 'Mengupdate data penjualan: ' . $nama_vendor;
            addlog($aksi, $ket);

            ajaxReturnDie('success', 'Data penjualan berhasil diperbarui', TRUE);


        }
    }


    public function deleteKategori($param1)
    {
            grantAccessFor('all');
            
            $id = decrypt($param1);
            $temp = $this->md_barang->getByIdKategori($id);
            $detail    = $temp[0]->name;

            $this->md_barang->deleteKategori($id);


            $aksi = 'Aset Perusahaan';
            $ket = 'Menghapus data kategori barang - ' . $detail;
            addlog($aksi, $ket);
            ajaxReturnDie('success', 'Data Berhasil Dihapus', TRUE);
    }


    public function deleteBarang($param1)
    {
            grantAccessFor('all');
            
            $id = decrypt($param1);
            $temp = $this->md_barang->getByIdBarang($id);
            $detail    = $temp[0]->name;

            $this->md_barang->deleteBarang($id);


            $aksi = 'Aset Perusahaan';
            $ket = 'Menghapus data barang - ' . $detail;
            addlog($aksi, $ket);
            ajaxReturnDie('success', 'Data Berhasil Dihapus', TRUE);
    }


    public function deletePembelian($param1)
    {
        grantAccessFor('all');

        $id = decrypt($param1);
        $pembelian = $this->md_barang->getPembelianById($id);
        $detail = $pembelian->nama_vendor;

        $this->md_barang->deleteIncomingByPembelian($id);
        $this->md_barang->deletePembelian($id);

        $aksi = 'Pembelian Barang';
        $ket  = 'Menghapus pembelian dari vendor - ' . $detail;
        addlog($aksi, $ket);

        ajaxReturnDie('success', 'Data pembelian dan barang terkait berhasil dihapus', TRUE);
    }


    public function deletePenjualan($param1)
    {
        grantAccessFor('all');

        $id = decrypt($param1);
        $penjualan = $this->md_barang->getPenjualanById($id);
        $detail = $penjualan->nama_penjual;

        $this->md_barang->deleteOutgoingByPenjualan($id);
        $this->md_barang->deletePenjualan($id);

        $aksi = 'Penjualan Barang';
        $ket  = 'Menghapus penjualan oleh penjual - ' . $detail;
        addlog($aksi, $ket);

        ajaxReturnDie('success', 'Data penjualan dan barang terkait berhasil dihapus', TRUE);
    }


    public function exportMasuk()
    {
        
         $data = $this->md_barang->getAllMasukByTGL($this->input->get('tglawal'),$this->input->get('tglakhir'));



          $spreadsheet = new Spreadsheet;
          $sheet = $spreadsheet->getActiveSheet();

            $style_col = [
              'font' => ['bold' => true], 
              'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $style_row = [
              'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $sheet->setCellValue('A1', "DATA Barang Masuk"); 
            $sheet->setCellValue('A2', "Periode: " . date('d-m-Y', strtotime($this->input->get('tglawal'))) . " s/d " . date('d-m-Y', strtotime($this->input->get('tglakhir'))));
            $sheet->mergeCells('A1:L1'); 
            $sheet->getStyle('A1')->getFont()->setBold(true); 
            
                    $sheet->setCellValue('A4', 'No');
                    $sheet->setCellValue('B4', 'Nama Barang');
                    $sheet->setCellValue('C4', 'Tanggal');
                    $sheet->setCellValue('D4', 'Jumlah');
                    
                    $sheet->getStyle('A4')->applyFromArray($style_col);
                    $sheet->getStyle('B4')->applyFromArray($style_col);
                    $sheet->getStyle('C4')->applyFromArray($style_col);
                    $sheet->getStyle('D4')->applyFromArray($style_col);


           $kolom = 5;
           $nomor = 1;
           
           foreach($data as $marketing) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $marketing->product_name)
                           ->setCellValue('C' . $kolom, $marketing->date)
                           ->setCellValue('D' . $kolom, $marketing->quantity);

               $kolom++;
               $nomor++;

          }

            $sheet->getColumnDimension('A')->setWidth(5); 
            $sheet->getColumnDimension('B')->setWidth(25); 
            $sheet->getColumnDimension('C')->setWidth(30); 
            $sheet->getColumnDimension('D')->setWidth(20); 
            
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $sheet->setTitle("Data Barang Masuk");
            ob_end_clean();
            $filename = "Data Barang Masuk.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            
            
    }

    public function exportKeluar()
    {
        
         $data = $this->md_barang->getAllKeluarByTGL($this->input->get('tglawal'),$this->input->get('tglakhir'));



          $spreadsheet = new Spreadsheet;
          $sheet = $spreadsheet->getActiveSheet();

            $style_col = [
              'font' => ['bold' => true], 
              'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $style_row = [
              'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $sheet->setCellValue('A1', "DATA Barang Keluar"); 
            $sheet->setCellValue('A2', "Periode: " . date('d-m-Y', strtotime($this->input->get('tglawal'))) . " s/d " . date('d-m-Y', strtotime($this->input->get('tglakhir'))));
            $sheet->mergeCells('A1:L1'); 
            $sheet->getStyle('A1')->getFont()->setBold(true); 
            
                    $sheet->setCellValue('A4', 'No');
                    $sheet->setCellValue('B4', 'Nama Barang');
                    $sheet->setCellValue('C4', 'Tanggal');
                    $sheet->setCellValue('D4', 'Jumlah');
                    
                    $sheet->getStyle('A4')->applyFromArray($style_col);
                    $sheet->getStyle('B4')->applyFromArray($style_col);
                    $sheet->getStyle('C4')->applyFromArray($style_col);
                    $sheet->getStyle('D4')->applyFromArray($style_col);


           $kolom = 5;
           $nomor = 1;
           
           foreach($data as $marketing) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $marketing->product_name)
                           ->setCellValue('C' . $kolom, $marketing->date)
                           ->setCellValue('D' . $kolom, $marketing->quantity);

               $kolom++;
               $nomor++;

          }

            $sheet->getColumnDimension('A')->setWidth(5); 
            $sheet->getColumnDimension('B')->setWidth(25); 
            $sheet->getColumnDimension('C')->setWidth(30); 
            $sheet->getColumnDimension('D')->setWidth(20); 
            
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $sheet->setTitle("Data Barang Keluar");
            ob_end_clean();
            $filename = "Data Barang Keluar.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            
            
    }


    public function exportStock()
    {
        
         $data = $this->md_barang->getAllStock();



          $spreadsheet = new Spreadsheet;
          $sheet = $spreadsheet->getActiveSheet();

            $style_col = [
              'font' => ['bold' => true], 
              'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $style_row = [
              'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
              ],
              'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
              ]
            ];


            $sheet->setCellValue('A1', "DATA STOCK BARANG"); 
            $sheet->mergeCells('A1:L1'); 
            $sheet->getStyle('A1')->getFont()->setBold(true); 
            
                    $sheet->setCellValue('A4', 'No');
                    $sheet->setCellValue('B4', 'Nama Barang');
                    $sheet->setCellValue('C4', 'Kode');
                    $sheet->setCellValue('D4', 'Kategori');
                    $sheet->setCellValue('E4', 'Jumlah');
                    $sheet->setCellValue('F4', 'Satuan');
                    
                    $sheet->getStyle('A4')->applyFromArray($style_col);
                    $sheet->getStyle('B4')->applyFromArray($style_col);
                    $sheet->getStyle('C4')->applyFromArray($style_col);
                    $sheet->getStyle('D4')->applyFromArray($style_col);
                    $sheet->getStyle('E4')->applyFromArray($style_col);
                    $sheet->getStyle('F4')->applyFromArray($style_col);


           $kolom = 5;
           $nomor = 1;
           
           foreach($data as $marketing) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $marketing->product_name)
                           ->setCellValue('C' . $kolom, $marketing->code)
                           ->setCellValue('D' . $kolom, $marketing->category_name)
                           ->setCellValue('E' . $kolom, $marketing->stock)
                           ->setCellValue('F' . $kolom, $marketing->unit);

               $kolom++;
               $nomor++;

          }

            $sheet->getColumnDimension('A')->setWidth(5); 
            $sheet->getColumnDimension('B')->setWidth(25); 
            $sheet->getColumnDimension('C')->setWidth(30); 
            $sheet->getColumnDimension('D')->setWidth(35); 
            $sheet->getColumnDimension('E')->setWidth(20); 
            $sheet->getColumnDimension('F')->setWidth(20); 
            
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $sheet->setTitle("Data Stock Barang");
            ob_end_clean();
            $filename = "Data Stock Barang.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            
            
    }



































}
