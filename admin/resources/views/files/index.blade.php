@extends('layouts.plantilla')

@section('title', 'Galeria de imágenes')

@section('content')
	
	{{ session(['name-section' => 'files']) }}

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h2 class="h2">#Galería</h2>
    	<div class="btn-toolbar mb-2 mb-md-0">
      		<div class="btn-group me-2">
    			<a href="{{ route('files.create') }}" class="btn btn-outline-primary">Carga una nueva imagen</a>
      		</div>
    	</div>
  	</div>

	<div class="table-responsive">

		<table class="table table-striped table-sm table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">#ID</th>
					<th scope="col">Título</th>
					<th scope="col" class="text-center">Imagen</th>
					<th scope="col" class="text-center">Categoría</th>
					<th scope="col" class="text-center">Estado</th>
					<th scope="col" class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody>

				@foreach( $files as $file )
					
					<tr>
						<th scope="row" class="text-center">#{{ $file->id }}</th>
						<td>{{ $file->title }}</td>
						<td class="text-center">
							
							<img src="{{asset('/assets/800x400/'.$file->url_size_1.'')}}" width="70px">
							
						</td>
						<td class="text-center">
							@foreach($tags as $tag)
								@if($tag->id == $file->tag_id)
									{{ $tag->name }}
								@endif
							@endforeach
						</td>
						<td>
							<div class="wrapper-estado">
								<span
									@if($file->state == 1)
										 class="wrapper-estado_habilitado"
									@else
										class="wrapper-estado_deshabilitado"
									@endif
								></span>
							</div>	
						</td>
						<td class="text-center">
							<div class="btn-acciones">
								<span>
									<a href="{{ route('files.edit', $file) }}">
										<img src="{{asset('assets/icons/edit.svg')}}" width="25px" />
									</a>
								</span>
								<div>
									<form action="{{ route('files.destroy', $file) }}" method="POST">
										@csrf

										@method('delete')

										<button type="submit" style="border: none;">
											<img src="{{asset('assets/icons/delete.svg')}}" width="30px" />
										</button>

									</form>
								</div>
							</div>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		
		{{ $files->links() }}

		<br>
		@if (session('status'))
		    <div class="alert alert-warning alert-dismissible fade show" role="alert">
		       	<strong> {{ session('status') }}</strong>
			  	<button type="button" id="alertas" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

	</div>	

@endsection
