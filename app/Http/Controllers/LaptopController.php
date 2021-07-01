<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use PDF;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laptop::latest()->paginate(5);
    
        return view('data_laptop.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_laptop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk_laptop' => 'required',
            'seri_laptop' => 'required',
            'thn_produksi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
  
        Laptop::create($input);
     
        return redirect()->route('data_laptop.index')
                        ->with('success','Data Berhasil Disimpan.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function edit(laptop $data_laptop)
    {
        return view('data_laptop.edit',compact('data_laptop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laptop $data_laptop)
    {
        $request->validate([
            'merk_laptop' => 'required',
            'seri_laptop' => 'required',
            'thn_produksi' => 'required',
        ]);

        $input = $request->all();
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        
        $data_laptop->update($input);
    
        return redirect()->route('data_laptop.index')
                        ->with('success','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laptop  $laptop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laptop $data_laptop)
    {
        $data_laptop->delete();
    
        return redirect()->route('data_laptop.index')
                        ->with('success','Data Berhasil Dihapus');
    }

    public function export(){
        $data_laptop = Laptop::all();

        view()->share('data_laptop', $data_laptop);
        $pdf = PDF::loadview('data_laptop_pdf');
        return $pdf->download('data_laptop.pdf');
    }
}
