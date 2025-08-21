<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

    function generateBtnAction($li_btn){
        $li='';
        foreach($li_btn as $row){
            $li.=$row;
        }
        return '<div class="dropdown dropdown-inline">
                    <button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        '.$li.'
                    </div>
                </div>';
    }

    function isKegiatanSudahMulai($tgl_mulai){
        return  date('Y-m-d') < date('Y-m-d',strtotime($tgl_mulai)) ? FALSE : TRUE;
    }

    function jenisKegiatan($val){
        switch ($val) {
            case '1':
                return 'FGD';
                break;
            case '2':
                return 'Seminar';
                break;
            case '3':
                return 'Lain-Lain';
                break;
            case '4':
                return 'Acara Pekanan';
                break;
        }
    }

    function jenisJenjang($val){
        switch ($val) {
            case '1':
                return 'Terdaftar';
                break;
            case '2':
                return 'Aktif';
                break;
            case '3':
                return 'Pemula';
                break;
            case '4':
                return 'Muda';
                break;
            case '5':
                return 'Madya';
                break;
            case '6':
                return 'Dewasa';
                break;
            case '7':
                return 'Ahli';
                break;
        }
    }

    function getColorStat($is_active) {
        if ($is_active == 0) {
            $dt_color = ['text'=> 'Tidak Aktif', 'color' => 'default']; 
        } else if ($is_active == 1) {
            $dt_color = ['text'=> 'Aktif', 'color' => 'success']; 
        } else if ($is_active == 2) {
            $dt_color = ['text'=> 'Keluar', 'color' => 'danger']; 
        } else if ($is_active == 3) {
            $dt_color = ['text'=> 'Meninggal', 'color' => 'warning']; 
        }
        return $dt_color;
    }
    /*
     * Pemberian seq sifatnya tidak terulang dan UNIQE
     */
    function getLatestSequence($kelas,$jk){
        $CI    = get_instance();
        $digit = 2;

        $x = $CI->md_grup->getLatestGrupByKelasJenisKelamin($kelas,$jk);

        $used_seq = $x ? $x[0]->seq : 0;
        
        //Cek seq sebelumnya 
            if($used_seq > 0){
                $old_seq = $used_seq;
                $data['unformat_seq'] = $old_seq + 1;
                $length_seq = strlen($data['unformat_seq']);

                if($length_seq==1){
                    $data['new_seq'] = '0'.$data['unformat_seq'];
                }
                else if($length_seq==2){
                    $data['new_seq'] = $data['unformat_seq'];
                }
            } 
            else {
                $data['new_seq'] = '01';
            }

        if($used_seq==99){
            $data['new_seq']      = '01';
        }

        return $data;
    } 

    /** Cek Pengisian Logbook minggu lalu */
    function cekBelumIsiLogbook($anggota_id){
        $CI = get_instance();
        
        /** Hanya Anggota Kelas 1 keatas yang perlu pengecekan isian logbook */
        if($CI->session->userdata('kelas')>0)
            return false;

        $week = 0;
        for ($i=0;$i<5;$i++) {
            $dt_week = getRangeWeekMonth(date('Y'), (int) date('m'), ($i+1));
            
            $today = date('Y-m-d');
            $weekStart = date('Y-m-d', strtotime($dt_week['week_start']));
            $weekEnd = date('Y-m-d', strtotime($dt_week['week_end']));
            
            if (($today >= $weekStart) && ($today <= $weekEnd)){
                /**
                 * Cek untuk minggu terakhir, jika week_start & week_end dibulan yang sama, maka dia masih termasuk minggu di bulan tersebu.
                 * Jika berbeda, berarti dia menjadi minggu pertama untuk bulan selanjutnya
                 */
                if ($i == 4 && date('m', strtotime($dt_week['week_start'])) != date('m', strtotime($dt_week['week_end']))) {
                    $week = $i;
                    break;   
                } else {
                    $week = ($i+1);
                    break;
                }
            }
        }
        $cek = $CI->md_anggota_logbook->getAnggotaLogbookBeforeWeek($anggota_id,$week);
        // echo_array($cek);die;
        
        return !$cek ? true : false;
    }
        
    function getListMurid($anggota_id){
        $CI = get_instance();
        $dtNext = $CI->md_anggota->getByWhere(['g.guru'=>$anggota_id]);
        foreach($dtNext as $row){
            $is_guru = $CI->md_grup->getByWhere(['guru'=>$row->anggota_id]);
            if($is_guru){
                $row->murid = getListMurid($row->anggota_id);
            } else {
                $row->murid = [];
            }
        }
        return $dtNext;
    }

    function rupiah_format($angka){
        return "Rp " . number_format($angka,2,',','.');
    }
    
function numberformat($angka){
    return number_format($angka, 2, ',', '.');
}
    
    function remove_rupiah_format($angka){
        $angka = str_replace("Rp ","", $angka);
        $angka = str_replace(".","", $angka);
        $angka = str_replace(",00","", $angka);
        return $angka;
    }

    function get_admin_by_kelas($kelas_id){
        $CI = get_instance();
        if(in_array($kelas_id,[1,2])){
            $dtadmin    = $CI->md_pengguna->getByJenis('1_2');
        } else if(in_array($kelas_id,[3,4])){
            $dtadmin    = $CI->md_pengguna->getByJenis('3_4');
        } else if(in_array($kelas_id,[5,6,7])){
            $dtadmin    = $CI->md_pengguna->getByJenis('5_6_7');
        }
        return $dtadmin;
    }
?>