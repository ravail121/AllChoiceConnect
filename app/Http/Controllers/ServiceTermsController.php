<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceTermsController extends Controller
{
    public function index()
    {
        return view('static-pages.terms');
    }
}
