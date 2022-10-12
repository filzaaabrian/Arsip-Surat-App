<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        
        $kategories = Kategori::all();

        if ($request->has('search')) {
            $surats = Surat::where('judul_surat', 'like', "%{$request->search}%")->paginate(5);
        } else {
            $surats = Surat::paginate(5);
        }

        return view('layouts.dashboard', compact('surats', 'kategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        if($request->isMethod('POST')){
            
            $fileName=time().'.'.$request->filesurat->extension();
            $request->file('filesurat') ->storeAs('public', $fileName);

            Surat::insert([
                'nomor_surat' => $request->nomorsurat,
                'kategori_surat' => $request->kategorisurat,
                'judul_surat' => $request->judulsurat,
                'file_surat' => $fileName
           ]) ;
        }
        
        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        // $fileName=time().'.'.$request->file->extensions();
        // $request->file('file') ->storeAs('public', $fileName);

        // if($request->isMethod('POST')){
            
        //     Surat::insert([
        //         'nomor_surat' => $request->nomorsurat,
        //         'kategori_surat' => $request->kategorisurat,
        //         'judul_surat' => $request->judulsurat,
        //         // 'file' => $fileName
        //    ]) ;
        // }
        
        // return redirect('/dashboard');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $dashboard)
    {

        $kategories = Kategori::all();
        return view('layouts.update', compact('dashboard', 'kategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Surat $dashboard, Request $request)
    {
        // dd($dashboard);
        
        if ($request->has('file_surat')) {
            $fileName=time().'.'.$request->filesurat->extension();
            $request->file('filesurat') ->storeAs('public', $fileName);
            
            $dashboard->update([
                'nomor_surat' => $request->nomorsurat,
                'kategori_surat' => $request->kategorisurat,
                'judul_surat' => $request->judulsurat,
                'file_surat' => $fileName
                ]) ;
            }
        else {
            $dashboard->update([
                'nomor_surat' => $request->nomorsurat,
                'kategori_surat' => $request->kategorisurat,
                'judul_surat' => $request->judulsurat
                ]) ;
        }
    
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $dashboard)
    {
        // dd($dashboard);
        Storage::disk('public')->delete($dashboard->file_surat);
        $dashboard->delete();
        
        return redirect()->back();

    }
}
