@extends('layouts.plantilla')

@section('title', 'Galeria de imágenes')

@section('content')
	
	<h2>Ver Imagen</h2>
	<a href=" {{ route('files.index') }} ">Volver</a>
	
	<h3>
		Nombre de la categoría: {{ $file->name }}
	</h3>

@endsection
