<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tours = Tour::simplePaginate(10);
        
        return view('tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     	return view('tour.create');
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
        //
            $validator = Validator::make($request->all(), [
                'title'     => 'required|min:3|max:20',
                'url'    	=> 'required',
                'img'       => 'required|images|mimes:jpg,jpeg,png|max:2048',
            ]);

        // valida y carga imagen 
            if ($request->hasFile('img'))
            {

                $nombre = md5( uniqid() . date("Y-m-d H:i:s") ) .'-'. $request->file('img')->getClientOriginalName();

                // nombre generado
                $tourvirtual360    = public_path()  .  '/assets/tourvirtual360/'. $nombre;
                Image::make( $request->file('img') )
                    ->resize(800, 533)
                    ->save($tourvirtual360);
                // $upload->move($path, $fileName);

                    $file = new Tour();
                        $file->title        = $request->title;
                        $file->url          = $request->url; // Enlace
                        $file->state        = ($request->state==1) ? 1: 0;
                        $file->img_inicial  = $nombre; // Imagen portada
                    $file->save();

                return redirect()->route('tour.index')->with('status', 'El registro se cargo correctamente.');
                
            }
            else 
                return redirect()->route('tour.index')->with('status', 'Error en la registro carga.');
            
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        //
        return view('tour.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        //
        $validator = Validator::make($request->all(), [
            'title'     => 'required|min:3|max:20',
            'url'    	=> 'required',
            'img'       => 'required|images|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = Tour::findOrFail($tour->id);
            $file->title        = $request->title;
            $file->url          = $request->url; // Enlace
            $file->state        = ($request->state==1) ? 1: 0;

            // Porcesa la carga de la imagen
            if ($request->hasFile('img'))
            {
                // nombre generado
           	    // Ruta para eliminar
                    $pathDeletetourvirtual360        = public_path()  . '/assets/tourvirtual360/'.$file->img_inicial;

                if( file_exists( $pathDeletetourvirtual360 ) )
                {
                    // despues Agrego
                       $nombre = $file->img_inicial;

                        $tourvirtual360    = public_path()  .  '/assets/tourvirtual360/'. $nombre;

                        Image::make( $request->file('img') )
                            ->resize(800, 533)
                            ->save($tourvirtual360);
                        
                        $file->img_inicial   = $nombre;

                        $file->save();

                        return redirect('/tour')->with('status', 'El registro se modifico correctamente.');
                        //return redirect()->route('tour.index')->with('status', 'El registro se modifico correctamente.');
                }
                else
                    return redirect()->route('tour.index')->with('status', 'Hubo un problema en la carga de la imagen.');
            }
            else
            {
                $file->save();

                return redirect('/tour')->with('status', 'El registro se modifico correctamente.');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
        // Ruta para eliminar
        	$tourvirtual360    = public_path()  .  '\assets\tourvirtual360\\'. $tour->img_inicial;
            
          

            $mensaje = "";
            if( file_exists( $tourvirtual360 ) )
                unlink( $tourvirtual360 );
            else
                $mensaje = 'Hubo un problema para eliminar imagen 800x400.';
            
        //
            
            if($tour->delete()) 
                $mensaje = 'El registro se borro correctamente.';
            else
                $mensaje = 'El registro se pudo ser eliminado.';

            return redirect()->route('tour.index')->with('status', $mensaje);;
    }
}
