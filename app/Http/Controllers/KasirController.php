<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use App\Http\Requests\StorekasirRequest;
use App\Http\Requests\UpdatekasirRequest;
use App\Models\databarang;
use App\Models\nomernota;
use App\Models\report;
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


        if (nomernota::all()->last() == null) {
            $nomernota = 1;
            nomernota::create(['iduser' => Auth::user()->id, 'nomernota' => $nomernota]);
        } else if (nomernota::all()->where('iduser', '=', Auth::user()->id)->last() == null || !isset(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)) {
            if (!isset(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)) {
                $nomernota = nomernota::all()->sortBy('nomernota')->last()->nomernota + 1;
                nomernota::create(['iduser' => Auth::user()->id, 'nomernota' => $nomernota]);
            } else {

                $modelupdate = nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id);
                $nomernota = nomernota::all()->sortByDesc('nomernota')->last()->nomernota + 1;
                $modelupdate->nomernota = $nomernota;
                $modelupdate->update();
            }
        } else if (nomernota::all()->where('iduser', '=', Auth::user()->id)->last() != null) {
            $nomernota = nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota;
        }

        $data = databarang::all()->whereNotNull('hargajual');
        $datakeranjang = kasir::where('nomernota', '=', $nomernota)->where('namakasir', '=', Auth::user()->name)->get();



        return view('pages.kasir', ['data' => $data, 'datakeranjang' => $datakeranjang, 'nomernota' => $nomernota]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fromdbbarang = databarang::find(request()->id);

        if ($fromdbbarang->jumlahbarang != 0) {


            $nomernota = nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota;


            if (count(kasir::all()->sortByDesc('updated_at')->where('namakasir', '=', Auth::user()->name)) > 0) {
                $checkadanamauser = kasir::all()->sortByDesc('updated_at')->where('namakasir', '=', Auth::user()->name)->first()->nomernota;
            } else {
                $checkadanamauser = 0;
            }

            if ($nomernota != $checkadanamauser || count(kasir::where('idbarang', '=', request()->id)->where('nomernota', '=', $nomernota)->get()) == 0) {
                kasir::create([
                    'nomernota' => $nomernota,
                    'namakasir' => Auth::user()->name,
                    'idbarang' => $fromdbbarang->id,
                    'barcode' => $fromdbbarang->barcode,
                    'namabarang' => $fromdbbarang->namabarang,
                    'jumlahbarang' => 1,
                    'hargajual' => $fromdbbarang->hargajual,
                ]);
            } else {
                $datakasir = kasir::find(kasir::where('idbarang', '=', request()->id)->where('nomernota', '=', $nomernota)->first()->id);
                $datakasir->jumlahbarang += 1;
                $datakasir->update();
                return redirect()->route('kasir.index');
            }
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

        $data = kasir::find(request()->id);
        if (request()->data != 0) {
            if ((int)request()->data > databarang::find($data->idbarang)->jumlahbarang) {
                $data->jumlahbarang = databarang::find($data->idbarang)->jumlahbarang;
                // dd('here');
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
    public function submitdata()
    {
        $datakeranjang = kasir::find(kasir::all()->where('nomernota', '=', nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota))->where('nomernota', '=', nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota);

        $datajumlah = [];
        foreach ($datakeranjang as $key => $value) {
            array_push($datajumlah, $value->hargajual * $value->jumlahbarang);
        }

        return view('pages.submitbarang', ['datakeranjang' => $datakeranjang, 'sumdata' => array_sum($datajumlah)]);
    }
    public function print()
    {
        // dd(request()->all());
        $getdatakasir = kasir::where('nomernota', '=', nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota)->get();

        foreach ($getdatakasir as $key => $value) {
            report::create([
                'nomernota' => nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id)->nomernota,
                'iduser' => Auth::user()->id,
                'idbarang' => $value->idbarang,
                'barangterjual' => $value->jumlahbarang,
                'hargajual' => $value->hargajual
            ]);
            $databarang = databarang::find($value->idbarang);
            $databarang->jumlahbarang -= $value->jumlahbarang;
            $databarang->update();
        }
        $datajumlah = [];
        foreach ($getdatakasir as $key => $value) {
            array_push($datajumlah, $value->hargajual * $value->jumlahbarang);
        }
        $nomernota = nomernota::find(nomernota::all()->where('iduser', '=', Auth::user()->id)->last()->id);
        $nomernota->nomernota = nomernota::all()->sortByDesc('nomernota')->first()->nomernota + 1;
        $nomernota->update();
        // dd('hello');

        return view('pages.print', ['total' => request()->total, 'datakasir' => $getdatakasir, 'nomernota' => $nomernota]);
    }
}