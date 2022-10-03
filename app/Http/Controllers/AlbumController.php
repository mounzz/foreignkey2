<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{

    public function index(){
        $albums = Album::all();
        return view('album', compact('albums'));
    }

    public function create(){

    }

    public function show(){

    }

    public function store(Request $request){
        $album = new Album;
        $album -> nom = $request -> nom;
        $album -> auteur = $request -> auteur;
        $photo = new Photo;
        Storage::put('public/img', $request->file('url'));
        $photo -> url = $request->file('url')->hashName();
        $photo -> save();
        $album -> photo_id = $photo->id;
        $album -> save();
        return redirect()->back();
    }

    public function edit(){

    }

    public function update(Request $request, $id){
        $update = Photo::find($id);
        if ($request->file('url') != null) {
            Storage::delete('public/img/' . $request->url);
            Storage::put('public/img/',  $request->file('url'));
            $update->url = $request->file('url')->hashName();
        }
        $update->save();
        return redirect()->back();
    }

    public function destroy($id){
        $delete = Album::find($id);
        Storage::delete('public/img/' . $delete->photo -> url);
        $delete -> photo()->delete();

        return redirect()->back();
    }
}
