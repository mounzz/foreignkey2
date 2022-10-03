@extends('layout.index')

@section('content')

<h1>créez votre album photo</h1>

<form action="/album" enctype="multipart/form-data" method="post">
    @csrf
    <input type="text" name="nom" id="" placeholder="nom">
    <input type="text" name="auteur" placeholder="auteur">
    <input type="file" name="url" id="url">
    <button type="submit">envoyer</button>
</form>


<h1>
    Vos albums
</h1>

@foreach ($albums as $album )

<div style="display:flex; gap: 1rem;">
<p>{{$album -> nom}}</p>
<p>{{$album -> auteur}}</p>
<p>
    <img src="{{asset('storage/img/' . $album -> photo -> url)}}" alt="" style="width: 2rem;">
</p>

<form action='{{url('album/' . $album -> id)}}' method='post'>
    @csrf
    @method('DELETE')
<button type="submit" style="background-color:brown;color:#fff;border: none;">supprimer</button>
</form>
<form action="album/{{$album -> id}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <input type="file" name="url" id="url">
    <button type="submit">update</button>
</form>
</div>
@endforeach

@endsection
