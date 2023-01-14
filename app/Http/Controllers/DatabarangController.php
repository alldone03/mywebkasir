<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Http\Requests\StoredatabarangRequest;
use App\Http\Requests\UpdatedatabarangRequest;
use Illuminate\Support\Facades\Auth;

class DatabarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = databarang::all();
        return view('pages.barang', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(request()->all());
        $validate = request()->validate([
            'barcode' => '',
            'namabarang' => 'required|unique:databarangs',
            'jumlahbarang' => 'required',
            'hargaawal' => 'required',
            'hargajual' => '',
        ]);
        databarang::create($validate);

        return redirect()->route('data.index')->with(['status' => 'Data berhasil diTambahkan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredatabarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredatabarangRequest  $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function show(databarang $databarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function edit(databarang $databarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedatabarangRequest  $request
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function update()
    {

        $data = databarang::find(request()->id);
        $data->barcode = request()->barcode;
        $data->namabarang = request()->namabarang;
        $data->jumlahbarang = request()->jumlahbarang;
        $data->hargaawal = request()->hargaawal;
        $data->hargajual = request()->hargajual;
        $data->update();
        return redirect()->route('data.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(databarang $databarang)
    {
        //
    }
}