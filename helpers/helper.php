<?php

use App\Models\Admin;
use App\Models\Pages;
function getSettingValue($key){
    return null;
    // return \DB::table('settings')->where('name', $key)->value('value');
}


function isAdmin()
{
    if (Auth::user()->is_super == 1) {
            return true;
    }
}

function getNotificationCount(){
    $admin = \Auth::user();
    
    // $admin = Admin::first();
        $notification_data = $admin->unreadNotifications;
        return $notification_data->count();
        
}

function isWarden()
{
    if (Auth::user()->type == 'Warden') {
            return true;
    }
    return false;
}

function isSecurity()
{
    if (Auth::user()->type == 'Security') {
            return true;
    }
    return false;
}

function isStudent()
{
    if (Auth::user()->type == 'Student') {
            return true;
    }
    return false;
}