@extends('index_master')
@section('konten')
<div class="col-md-12 mt-2 ms-2">
    <a href="{{ url('cart') }}" class="btn btn-danger mt-3">Back</a>
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Cart</li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="ps-checkout__form" action="" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-md-8">
                        <h3 class="mt-5 mb-5">Alamat Pengiriman</h3>
                        <div class="form-group ">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="" id="" placeholder="{{Auth::user()->name}}" value="{{Auth::user()->name}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="" id="" placeholder="" value="">
                        </div>
                        {{-- <label>Provinsi asal</label> --}}
                        <input type="hidden" value="9" class="form-control" name="province_origin">
                        </div>
                        <div class="form-group ">
                        {{-- <label>Kota Asal</label> --}}
                        <input type="hidden" value="16416" class="form-control" id="city_origin" name="city_origin">
                        </div>
                        <br>
                        <div class="form-group ">
                        <label>Alamat<span>*</span>
                        </label>
                        <textarea name="address" class="form-control" rows="5" placeholder="Alamat Lengkap pengiriman" ></textarea>
                        </div>
                        <br>
                        <div class="form-group ">
                        <label>Provinsi Tujuan<span>*</span>
                        </label>
                        <select name="provinsi_id" id="provinsi_id" class="form-control">
                            <option value="">pilih Provinsi</option>
                            @foreach ($provinsi  as $row)
                            <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="nama_provinsi" nama="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
                        </div>
                        <br>
                        <div class="form-group ">
                        <label>Kota Tujuan<span>*</span>
                        </label>
                        <select name="kota_id" id="kota_id" class="form-control">
                        <option value="">Pilih Kota</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="nama_kota" name="nama_kota" placeholder="ini untuk menangkap nama kota">
                        </div>
                        <br>
                        <div class="form-group ">
                            <label>Pilih Ekspedisi<span>*</span>
                            </label>
                            <select name="kurir" id="kurir" class="form-control">
                            <option value="">Pilih kurir</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS INDONESIA</option>
                            </select>
                            </div>
                            <br>
                            <div class="form-group">
                            <label>Pilih Layanan<span>*</span>
                            </label>
                            <select name="layanan" id="layanan" class="form-control">
                            <option value="">Pilih layanan</option>
                            </select>
                        </div>
                         <br>
                        <div class="form-group ">
                        <label>Kode Pos<span>*</span>
                        </label>
                        <input type="text" name="kode_pos" class="form-control" >
                        </div>
                        </div>
                        <div class="col-md-4">
                        {{-- <div class="form-group ">
                        <label>total keseluruhan </label>
                        <input class="form-control" type="text" id="ongkos_kirim" name="ongkos_kirim" >
                        </div> --}}
                        {{-- <div class="form-group">
                        <button class="btn btn-primary" type="submit">Proses Order</button>
                        </div> --}}
                        </div>
                        </div>
                        </form>
                    {{-- <h6>Form Data</h6>
                    <hr>
                    <label>Name</label>
                    <input type="text" name="" id="" placeholder="{{Auth::user()->name}}" value="{{Auth::user()->name}}">
                    <hr>
                    <label>Phone</label>
                    <input type="number" name="" id="" placeholder="" value="">
                    <hr>
                    <label>Alamat</label>
                    <input type="text" name="" id="" placeholder="" value="">
                    <hr>
                    <label>Province</label>
                    <select name="" id="">
                        <option value="">Province</option>
                    </select>
                    <label>City</label>
                    <select name="" id="">
                        <option value="">City</option>
                    </select> --}}
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h6>Produk Order</h6>
                    <hr>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Harga</th>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @php 
                            $weight = 0; 
                            // $plus = 1000;
                            @endphp
                            @foreach ($cartitems as $item)
                            <tr>
                                <td> {{ $item->products->name_produk }}</td>
                                <td> {{ $item->prod_stok }}</td>
                                <td> {{ $item->products->harga }}</td>
                            </tr>
                            @php 
                            $weight += $item->products->weight * $item->prod_stok
                            @endphp
                            @php $total += $item->products->harga * $item->prod_stok; @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer">
                        <label>total ongkos kirim </label>
                        <input class="form-control" type="text" id="ongkos_kirim" name="ongkos_kirim" disabled>
                        <label>total berat (gram) </label>
                        <input class="form-control" type="text" value="{{ $weight }}" id="weight" name="weight" disabled>
                        {{-- <h6><strong>Weight : {{ $weight }}</strong></h6> --}}
                        <label>Total Belanja </label>
                        <input class="form-control" type="text" value="{{ $total }}" id="harga" name="harga" disabled>
                        <h6><strong>TOTAL PRICE : </strong></h6>
                        <input disabled type="text" name="total" id="total" class="form-control">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection