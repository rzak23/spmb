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