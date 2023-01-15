<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use App\Http\Requests\StorekasirRequest;
use App\Http\Requests\UpdatekasirRequest;
use App\Models\databarang;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = databarang::all();
        $datakeranjang = kasir::all();
        return view('pages.kasir', ['data' => $data, 'datakeranjang' => $datakeranjang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fromdbbarang = databarang::find(request()->id);

        $nomernota = 1;
        // dd(kasir::where('idbarang', '=', request()->id)->first()->id, databarang::find(request()->id)->first()->id);
        if (databarang::find(request()->id)->first()->id == isset(kasir::where('idbarang', '=', request()->id)->first()->idbarang)) {
            $datakasir = kasir::find(kasir::where('idbarang', '=', request()->id)->first()->id);
            $datakasir->jumlahbarang += 1;
            $datakasir->update();
            return redirect()->route('kasir.index');
        } else {
            kasir::create([
                'nomernota' => $nomernota,
                'namakasir' => Auth::user()->name,
                'idbarang' => $fromdbbarang->id,
                'barcode' => $fromdbbarang->barcode,
                'namabarang' => $fromdbbarang->namabarang,
                'jumlahbarang' => 1,
                'hargajual' => $fromdbbarang->hargajual,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorekasirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekasirRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function show(kasir $kasir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // dd(request()->all());
        $data = kasir::find(request()->id);
        // dd($data->idbarang);
        // dd(databarang::find($data->idbarang)->jumlahbarang);
        if (request()->data != 0) {

            if (request()->data > databarang::find($data->idbarang)->jumlahbarang) {
                $data->jumlahbarang = databarang::find($data->idbarang)->jumlahbarang;
            } else {
                $data->jumlahbarang = request()->data;
            }
            $data->update();
        } else {
            $data->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'success', 'data' => $data->jumlahbarang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekasirRequest  $request
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekasirRequest $request, kasir $kasir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasir $kasir)
    {
        //
    }
}