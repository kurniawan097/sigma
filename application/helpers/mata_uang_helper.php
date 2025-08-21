<?php
    //format currency
    function mata_uang($kode){
        if($kode == 1){
            $mata_uang = "Rp. ";
        }else if($kode == 2){
            $mata_uang = "$ ";
        }
        return $mata_uang;
    }
    
	//format nominal sesuai currency
    function nominal($kode, $nom){
        if($kode == 1){
            $nominal = number_format($nom,0,",",".");
			$nominal .= ",-";
        }else if($kode == 2){
            $nominal = number_format($nom,2,".",",");
        }
        return $nominal;
    }
?>