@extends('data_laptop.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <br>
        <div class="pull-left">
            <h2>Tambah Data</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('data_laptop.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Merk Laptop</label>
                <input type="text" name="merk_laptop" class="form-control" placeholder="Merk Laptop">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Seri Laptop</label>
                <input type="text" name="seri_laptop" class="form-control" placeholder="Seri Laptop">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Tahun Produksi</label>
                <input type="number" name="thn_produksi" class="form-control" placeholder="Tahun Produksi">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" placeholder="image">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <a class="btn btn-dark" href="{{ route('data_laptop.index') }}">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>    
        </div>
    </div>
   
</form>
@endsection