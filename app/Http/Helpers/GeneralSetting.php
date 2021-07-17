<?php

/* 
    Name : GeneralSettings 
    Description : Have all methods that handule all web app setings 
    Author : Ahmed Wagih 
    Contacnt : 01027887897 / a.ahmedwageh@gmail.com
*/
use App\Models\AppSettings;

if(!function_exists('getAppSettings')){
    function getAppSettings(){
        return AppSettings::latest()->first();
    }
}