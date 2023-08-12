<!DOCTYPE html>
<html lang="es">
<head>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Salar Marcelo">
    <meta name="generator" content="Panel 0.1.0">
	<meta name="theme-color" content="#7952b3">

	<title>@yield('title')</title>

    <!-- Favicons -->
		{{-- <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
		<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
		<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
		<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
		<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
		<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico"> --}}

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

</head>
<body>

	<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

	  	<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Matt360view</a>
  		
  		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="navbar-nav">
	    	<div class="nav-item text-nowrap">
	      		{{-- <a class="nav-link px-3" href="#">Sign out</a> --}}
	      		<form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                		class="nav-link px-3"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>

	    	</div>
	  	</div>

	</header>
	
	<div class="container-fluid">

		<div class="row">

			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

		      	<div class="position-sticky pt-3">
		        	<ul class="nav flex-column">
		          		<li class="nav-item">
		            		<a 
		            			@if(session('name-section') == 'tags')
		            				class="nav-link active"
		            			@else
		            				class="nav-link"
		            			@endif  
		            			href="{{route('tags.index')}}">
		              			<span data-feather="file">
		              				<img src="{{ asset('assets/icons/file.svg') }}" width="25px">
		              			</span>
		              			Categorías
		            		</a>
		          		</li>
		          		<li class="nav-item">
		            		<a 
		            			@if(session('name-section') == 'files')
		            				class="nav-link active"
		            			@else
		            				class="nav-link"
		            			@endif  
	            				aria-current="page" href="{{route('files.index')}}">
		              			<span data-feather="home">
		              				<img src="{{ asset('assets/icons/tag.svg') }}" width="25px">
		              			</span>
		              			Galería
		            		</a>
		          		</li>
		          		<li class="nav-item">
		            		<a 
		            			@if(session('name-section') == 'videos')
		            				class="nav-link active"
		            			@else
		            				class="nav-link"
		            			@endif  
		            			href="{{route('videos.index')}}">
		              			<span data-feather="video">
		              				<img src="{{ asset('assets/icons/file.svg') }}" width="25px">
		              			</span>
		              			Videos
		            		</a>
		          		</li>
		          		<li class="nav-item">
		            		<a 
		            			@if(session('name-section') == 'tour')
		            				class="nav-link active"
		            			@else
		            				class="nav-link"
		            			@endif  
		            			href="{{route('tour.index')}}">
		              			<span data-feather="video">
		              				<img src="{{ asset('assets/icons/file.svg') }}" width="25px">
		              			</span>
		              			Tour Virtual 360
		            		</a>
		          		</li>
		        	</ul>
		      	</div>
		    </nav>

		    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		      	
				@yield('content')

		    </main>
			
		</div>
			
	</div>

	<script type="text/javascript">
		
		if (typeof document.getElementById('alertas') == "object" && document.getElementById('alertas') != null) 		{
			document.getElementById('alertas').addEventListener('click', function() {
				this.parentNode.classList.remove('show');
			}, false);
		}
		
	</script>
	
</body>
</html>