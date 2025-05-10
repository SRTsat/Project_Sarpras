<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApiBarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return response()->json([
            'data' => $barangs
        ]);
    }
}
