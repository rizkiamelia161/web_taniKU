<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        $flashsale = Produk::latest()->paginate(4);

        $kategori = Kategori::all();
        return view('halaman.index', compact('produks', 'kategori', 'flashsale'));

    }

    public function showprofil(){
        return view('halaman.profil');
    }

    public function showabout(){
        return view('halaman.about');
    }

    public function viewpesanan()
    {
        $orders = Order::where('user_id', Auth::id())->where('status', 'Paid')->get();

        return view('halaman.page_pesanan', compact('orders'));
    }

    public function detailpesanan($id)
    {
        $pesanan = Order::where('id', $id)->first();

        return view('halaman.pesanan.detail_pesanan', compact('pesanan'));
    }
}
