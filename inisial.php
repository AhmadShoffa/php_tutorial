<?php
    function inisial($nama){
        $arr = explode(' ', $nama);
        $singkatan = '';
        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }
        return $singkatan;
    }
    echo inisial("Burham Andreas Siswo Utomo");
?>
