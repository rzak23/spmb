<?php

function auth(){
    static $auth;

    if(!$auth){
        $auth = new \App\Libraries\Auth();
    }

    return $auth;
}