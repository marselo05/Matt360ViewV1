<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
// use Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $files = [];
        $files = File::orderBy('tag_id', 'desc')->simplePaginate(20);
        $tags  = Tag::all();
        // dd($files);
        
        return view('files.index', compact('files','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::all();

        if(count($tags)>0)
            return view('files.create', compact('tags'));
        else
            return view('tags.create');

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
            $validator = Validator::make($request->all(), [
                'title'     => 'required|min:3|max:20',
                'tag_id'    => 'required',
                'img'       => 'required|images|mimes:jpg,jpeg,png|max:2048',
            ]);

        // valida y carga imagen 
            if ($request->hasFile('img'))
            {

                $nombre = md5( uniqid() . date("Y-m-d H:i:s") ) .'-'. $request->file('img')->getClientOriginalName();

                $fileName1200x800   = public_path()  . '/assets/1200x800/'. $nombre;
                
                Image::make( $request->file('img') )
                    ->resize(1200, 800)
                    ->save($fileName1200x800);

                // nombre generado
                $fileName800x400    = public_path()  .  '/assets/800x400/'. $nombre;
                Image::make( $request->file('img') )
                    ->resize(800, 533)
                    ->save($fileName800x400);
                

                    $file = new File();
                        $file->title        = $request->title;
                        $file->tag_id       = $request->tag_id;
                        $file->state        = ($request->state==1) ? 1: 0;
                        $file->url_size_1   = $nombre;
                        $file->url_size_2   = $nombre;
                    $file->save();

                return redirect()->route('files.index')->with('status', 'El registro se cargo correctamente.');
                
            }
            else 
                return redirect()->route('files.index')->with('status', 'Error en la registro carga.');
            
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
        // $file::find($file);

        // return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
        $tags = Tag::all();
        return view('files.edit', compact('file','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        
        // dd($request);
        // dd($files);
        $validator = Validator::make($request->all(), [
            'title'     => 'required|min:3|max:20',
            'tag_id'    => 'required',
            'img'       => 'required|images|mimes:jpg,jpeg,png|max:2048',
        ]);

        
        $file = File::findOrFail($file->id);
            $file->title        = $request->title;
            $file->tag_id       = $request->tag_id;    
            $file->state        = ($request->state == 1) ? 1 : 0;

    
            // Porcesa la carga de la imagen
            if ($request->hasFile('img'))
            {
                
                // $path       = public_path() . '..\..\..\..\assets\800x400\\';   
                // Ruta para eliminar
                    $pathDelete800x400        = public_path()  . '/assets/800x400/'.$file->url_size_1;
                    $pathDelete1200x800       = public_path()  . '/assets/1200x800/'.$file->url_size_1;
                    

                if( file_exists( $pathDelete800x400 ) && file_exists($pathDelete1200x800))
                {   
                    // despues Agrego
                        $nombre = $file->url_size_1;
                        $fileName1200x800   = public_path()  . '/assets/1200x800/'. $nombre;
                        Image::make( $request->file('img') )
                            ->resize(1200, 800)
                            ->save($fileName1200x800);

                        // nombre generado
                        $fileName800x400    =  public_path()  . '/assets/800x400/'. $nombre;
                        Image::make( $request->file('img') )
                            ->resize(800, 533)
                            ->save($fileName800x400);
                        
                        $file->url_size_1   = $nombre;
                        $file->url_size_2   = $nombre;
                        
                        
                        $file->save();

                        return redirect('/files')->with('status', 'El registro se modifico correctamente.');
                }
                else{
                    return redirect()->route('files.index')->with('status', 'Hubo un problema en la carga de la imagen.');
                }
            }
            else {
                // return redirect()->route('files.index')->with('status', 'El registro se modifico correctamente.');
                return redirect('/files')->with('status', 'El registro se modifico correctamente.');

            }

        
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function delete(File $file)
    {
    
        // Ruta para eliminar
            $pathDelete800x400        = public_path()  . '/assets/800x400/'.$file->url_size_1;
            $pathDelete1200x800       = public_path()  . '/assets/1200x800/'.$file->url_size_2;

            $mensaje = "";
            if( file_exists( $pathDelete800x400 ) )
                unlink( $pathDelete800x400 );
            else
                $mensaje = 'Hubo un problema para eliminar imagen 800x400.';
            
            if (file_exists($pathDelete1200x800)) 
                unlink( $pathDelete1200x800 );
            else
                $mensaje = 'Hubo un problema para eliminar imagen 1200x800.';
        //
            
            if($file->delete()) 
                $mensaje = 'El registro se borro correctamente.';
            else
                $mensaje = 'El registro se pudo ser eliminado.';

            return redirect()->route('files.index')->with('status', $mensaje);;
    }
}
