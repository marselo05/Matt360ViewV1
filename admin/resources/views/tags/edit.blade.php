@extends('layouts.plantilla')

@section('title', 'Editar categoría')

@section('content')
	
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h2 class="h2">#Modificar categoría</h2>
    	<div class="btn-toolbar mb-2 mb-md-0">
      		<div class="btn-group me-2">
        		<a href="{{route('tags.index')}}" class="btn btn-outline-primary">Volver</a>
      		</div>
    	</div>
  	</div>

	<div class="cont-formulario">

		<form action="{{route('tags.update', $tag)}}" method="POST">
			
			@csrf
			
			@method('put')

		  	<div class="row">
			  	<div class="col">
				    <label for="categoria">Categoría</label>
				    <input type="text" name="name" class="form-control" id="categoria" value="{{ old('name', $tag->name) }}">
			  	</div>

			  	@error('name')
			  		<small>*{{$message}}</small>
			  	@enderror
			</div>
			
			<br>
			<div class="row">
			  	<div class=" col form-check">
				    <input type="checkbox" class="form-check-input" name="state" value="1" id="state" 
					    @if($tag->state == 1) 
					    	checked 
					    @endif
				    >
				    <label class="form-check-label" for="state">Estado</label>
			  	</div>
			</div>  	

			<br>
		  	<div class="row">
		  		<div class="col">
		  			<button type="submit" class="btn btn-primary">Modificar</button>
		  		</div>
		  	</div>	

		</form>

	</div>
	<script type="text/javascript">
		
		document.querySelector('#state').addEventListener('click', function() {
			this.value = (!this.checked) ? 0 : 1;
		}, false);

	</script>

@endsection
