<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\karyawan;

class karyawansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['karyawans'] = karyawan::all();
       return view('karyawan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $karyawan = new karyawan();
        $karyawan->nik = $request->input('nik');
        $karyawan->nama = $request->input('nama');
        $karyawan->jabatan = $request->input('jabatan');
        
        $karyawan->save();
        echo "sukses";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $karyawan = karyawan::find($id);
        //dd($karyawan);
        echo json_encode($karyawan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $karyawan = karyawan::find($id);
        $karyawan->nik = $request->input('nik');
        $karyawan->nama = $request->input('nama');
        $karyawan->jabatan = $request->input('jabatan');
        
        $karyawan->save();
        echo "sukses";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $karyawan = karyawan::find($id);
        $karyawan->delete();
        echo "sukses";
    }
    public function ubah(Request $request, $id)
    {
        $karyawan = karyawan::find($id);
        $karyawan->nik = $request->input('nik');
        $karyawan->nama = $request->input('nama');
        $karyawan->jabatan = $request->input('jabatan');
        
        $karyawan->save();
        echo "sukses";
    }
    public function hapus($id)
    {
        # code...
        $karyawan = karyawan::find($id);
        $karyawan->delete();
        echo "sukses";
    }
}
