@extends('data_laptop.layout')
 
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Laptop</h2>
                <h5>Selamat datang, <strong>{{ Auth::user()->name }}</strong></h5>
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('data_laptop.create') }}">Tambah Data Laptop</a>
                <a href="/export" class="btn btn-info">Export PDF</a>
            </div>
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Merk Laptop</th>
            <th>Seri Laptop</th>
            <th>Tahun Produksi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $value->image }}" width="100px"></td>
            <td>{{ $value->merk_laptop }}</td>
            <td>{{ $value->seri_laptop }}</td>
            <td>{{ $value->thn_produksi }}</td>
            <td>
                <form action="{{ route('data_laptop.destroy',$value->id) }}" method="POST">     
                    <a class="btn btn-primary" href="{{ route('data_laptop.edit',$value->id) }}">Edit</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $data->links() !!}      
@endsection