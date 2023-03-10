<?php
use Illuminate\Support\Facades\Auth;

function isLogin(){
    if(Auth::guard("web")->check()){
        return true;
    }else{
        return false;
    }
}

function getYangLogin()
{
    if(isLogin() == false){
        return null;
    }else{
        return Auth::guard('web')->user();

    }
}


