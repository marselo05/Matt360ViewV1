<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('videos.create');
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
        $request->validate([
            'title'  => 'required',
            'url'    => 'required'
        ]);

        $video = new Video();

            $video->title  = $request->title;
            $video->url    = $request->url;   
            $video->state  = ($request->state == 1) ? 1 : 0;

        $video->save();

        return redirect()->route('videos.index')->with('status', 'El registro se cargo correctamente.');

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
    public function edit(Video $video)
    {
        //
        $videos = Video::find($video->id);
        
        return view('videos.edit', compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'  => 'required',
            'url'    => 'required'
        ]);

        $video = Video::find($video->id);
            $video->title  = $request->title;
            $video->url    = $request->url;   
            $video->state  = ($request->state == 1) ? 1 : 0;
        $video->update();

        return redirect()->route('videos.index')->with('status', 'El registro se modifico correctamente.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        $video->delete();
        
        return redirect()->route('videos.index')->with('status', 'El registro se elimino correctamente.');;   
    }
}
