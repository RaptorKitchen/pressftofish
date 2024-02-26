<?php

namespace App\Http\Controllers;

class MirrorController extends Controller
{
    public function index()
    {
        dd("Hello from MirrorController@index");
        return view('mirror');
    }
}