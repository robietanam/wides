<?php

namespace App\Http\Controllers\Homepage;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $tourPackages = TourPackage::all();
        return view('pages.homepage-v2', ['tourPackages' => $tourPackages]);
    }
}
