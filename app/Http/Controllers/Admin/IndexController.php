<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends controller
{
    /*
    *后台首页
    */
    public function index()
    {
        return view('admin.index');
    }

}