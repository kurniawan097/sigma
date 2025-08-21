<?php

/**
 * Return json response and die 
 */
function ajaxReturnDie($status, $text, $reload = FALSE)
{
	echo json_encode(array('status' => $status, 'msg' => $text, 'reload' => $reload));
	die;
}

/**
 * Print array with pre tah
 */
function echo_array($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

/**
 * Encrypt Helper
 * @todo mengubah integer menjadi suatu angka dengan menggunakan library hashids (https://hashids.org)
 */
function hashidsInitialize($minLength = 5)
{
	$salt          = 'IRR839GBnv22';
	$minHashLength = $minLength;
	$alphabet      = 'siw82ug75y2hfsbc8a02ds8g4hhghajhk912';
	return new Hashids\Hashids($salt, $minHashLength, $alphabet);
}


function encrypt($param)
{
	$hashids = hashidsInitialize(6);
	return $hashids->encode($param);
}
function decrypt($param)
{
	if ($param) {
		$hashids = hashidsInitialize(6);
		return $hashids->decode($param)[0];
	}
	return true;
}



/**
 * Log Input
 */
function addlog($aksi = '', $ket = '')
{
	$CI = get_instance();
	$log['jenis_aksi']  = $aksi;
	$log['keterangan']  = $ket;
	// $log['pengguna_id'] = isAdmin() || isAdminCluster() ? decrypt($CI->session->userdata('pengguna_id')) : null;
	$log['pengguna_id'] = decrypt($CI->session->userdata('pengguna_id'));
	$log['ip_addr']     = $_SERVER['REMOTE_ADDR'];
	$CI->md_log->addlog($log);
	return true;
}

/**
 * Notif Input
 */


/**
 * Check Empty Form
 */
function checkEmptyForm($data, $exclude_list = array())
{
	$empty = 0;
	foreach ($data as $key => $val) {
		if (!$val && !in_array($key, $exclude_list))
			$empty++;
	}
	if ($empty)
		ajaxReturnDie('error', 'Form dengan tanda (<span class="text-danger">*</span>) Tidak Boleh Kosong');

	return TRUE;
}

function checkEmptyFormTiket($data, $exclude_list = array()) 
{
    $empty = 0;
    
    foreach ($data as $key => $val) {
        if (!$val && !in_array($key, $exclude_list)) {
            $empty++;
        }
        // Cek jika field 'des_peker' kurang dari 100 karakter
        if ($key === 'des_peker' && strlen(trim($val)) < 100) {
            ajaxReturnDie('error', 'Form <b>Deskripsi Pekerjaan</b> harus berisi minimal 100 karakter');
        }
    }

    if ($empty) {
        ajaxReturnDie('error', 'Form <b>Bukti Kerja</b> Tidak Boleh Kosong');
    }

    return TRUE;
}


function rupiah($angka){
	if ($angka == NULL){
		return '';
	} else {
		$hasil_rupiah = trim(number_format($angka));
		return $hasil_rupiah;
	}
}

function delete_currency($angka){
	if ($angka == NULL){
		return '';
	} else {
		$x = ['.', ','];
		$hasil = str_replace($x, "", $angka);
		return $hasil;
	}
}

/**
 * Check Empty Form
 */
function isEmptyArray($arr)
{
	$empty = 0;
	foreach ($arr as $key => $val) {
		if (!$val)
			$empty++;
	}
	if ($empty)
		return TRUE;

	return FALSE;
}

function FileUpload($name_input, $id = null, $id_name = null)
{
	$CI = get_instance();
	$result_error = array();
	$files       = $_FILES[$name_input];
	$jumlah_file = sizeof($_FILES[$name_input]['tmp_name']);
	// echo_array($jumlah_file);
	for ($i = 0; $i < $jumlah_file; $i++) {
		if ($files['size'][$i] > 0) {
			$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|docx|DOCX|doc|DOC|pdf|PDF|xls|xlsx|zip|ZIP|rar|RAR|txt|TXT';
			$config['max_size']      = '4000';
			$config['file_name']     = url_title($files['name'][$i]);
			$config['upload_path']   = './uploads';
			// $config['overwrite']     = true;
			$CI->upload->initialize($config);
			ini_set('memory_limit', '-1');

			$_FILES[$name_input]['name']     = $files['name'][$i];
			$_FILES[$name_input]['type']     = $files['type'][$i];
			$_FILES[$name_input]['tmp_name'] = $files['tmp_name'][$i];
			$_FILES[$name_input]['error']    = $files['error'][$i];
			$_FILES[$name_input]['size']     = $files['size'][$i];

			if ($CI->upload->do_upload($name_input)) {
				$dt = $CI->upload->data();
				$data['nama_file']   = $dt['raw_name'] . $dt['file_ext'];
				$data['jenis']       = $dt['file_type'];
				if ($id_name)
					$data[$id_name]  = $id;

				$CI->md_media->addMedia($data);

				if ($id_name == 'kagenda_id') {
					/** LOG */
					$tmp = $CI->md_kegiatan_agenda->getByWhere(['kagenda_id' => $id]);
					addLog('Upload File Agenda', 'Mengupload file ' . $data['nama_file'] . ' pada agenda ' . $tmp[0]->judul_agenda . ' di kegiatan ' . $tmp[0]->judul_kegiatan);
				}
			} else {
				ajaxReturnDie('error', $CI->upload->display_errors());
			}
		}
	}
	$txtError = '';
	if ($result_error) {
		foreach ($result_error as $re) {
			$txtError .= $re;
		}
	}
	return $txtError;
}
