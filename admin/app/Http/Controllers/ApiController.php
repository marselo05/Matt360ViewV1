<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Tag;
use App\Models\File;
use App\Models\Tour;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	header('Access-Control-Allow-Origin: *');
	//aquí agregamos solo los metodos que necesitemos
	header('Access-Control-Allow-Methods: GET');
        //
        $videos  = Video::all();
        $tags    = Tag::all();
        $files 	 = File::all();
        $tours    = Tour::all();

        // $res=[];
        // for ($i=0; $i < count($tags); $i++) 
        // { 
        //     for ($ii=0; $ii < count($files); $ii++) 
        //     { 
        //         if ($files[$ii]->tag_id == $tags[$i]->id ) 
        //         {
        //             $res = [
        //                 $files[$ii]->tag_id,
        //                 $files[$ii]->url_size_1,
        //                 $tags[$i]->name
        //             ];
        //         }
                
        //     }    
        // }
        // $res = DB::select('SELECT 
        //     files.url_size_1 AS url, 
        //     tags.id, 
        //     tags.name 
        //     FROM 
        //         tags, files 
        //     WHERE (   tags.state=1 AND files.state=1)  
        //     GROUP BY 
        //     tags.state,
        //     files.state,
        //     files.url_size_1, 
        //     tags.id, 
        //     tags.name');
        

        return compact('videos', 'tags', 'files', 'tours');
    }
}
