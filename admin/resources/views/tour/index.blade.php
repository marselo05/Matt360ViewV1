@extends('layouts.plantilla')

@section('title', 'Tour Virtual 360')

@section('content')
	
	{{ session(['name-section' => 'tour']) }}
	
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h2 class="h2">#TourVirtual360</h2>
    	<div class="btn-toolbar mb-2 mb-md-0">
      		<div class="btn-group me-2">
				<a href="{{route('tour.create')}}" class="btn btn-outline-primary">Cargar un nuevo registro</a>
      		</div>
    	</div>
  	</div>

	<div class="table-responsive">

		<table class="table table-striped table-sm table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">#</th>
					<th scope="col">Título</th>
					<th scope="col">Imágen</th>
					<th scope="col" class="text-center">Enlace</th>
					<th scope="col" class="text-center">Estado</th>
					<th scope="col" class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $tours as $tour )
					<tr>
						<th scope="row" class="text-center">#{{$tour->id}}</th>
						<td>{{$tour->title}}</td>
						<td class="text-center">
							
							<img src="{{asset('/assets/tourvirtual360/'.$tour->img_inicial.'')}}" width="70px">
							
						</td>
						<td>{{$tour->url}}</td>
						<td class="text-center">
							<div class="wrapper-estado">
								<span
									@if($tour->state == 1)
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
									<a href="{{ route('tour.edit', $tour) }}">
										<img src="{{asset('assets/icons/edit.svg')}}" width="25px" />
									</a>
								</span>
								<form action="{{route('tour.destroy', $tour)}}" method="POST">
									@csrf
									@method('delete')
									<button type="submit">
										<img src="{{asset('assets/icons/delete.svg')}}" width="30px" />
									</button>
								</form>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		@if (session('status'))
		    <div class="alert alert-warning alert-dismissible fade show" role="alert">
		       	<strong> {{ session('status') }}</strong>
			  	<button type="button" id="alertas" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

	</div>
	
	

@endsection
