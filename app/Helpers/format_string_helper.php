<?php

function status_siswa(int $id): string
{
    $res = "";
    if($id == 1){
        $res = "WNI";
    }else if($id == 2){
        $res = "WNA";
    }

    return $res;
}

function nama_jk(string $initial): string
{
    $res = "";
    if($initial == "l"){
        $res = '<i class="fas fa-male text-primary"></i>';
    }else if($initial == "p"){
        $res = '<i class="fas fa-female text-fuchsia"></i>';
    }

    return $res;
}