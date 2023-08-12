<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'name'  => 'required',
        ]);

        // valido en base
        $fl = false; 
        $tags = Tag::all();
        foreach ($tags as $tt) {
            if (strtolower($tt->name) == strtolower($request->name)) {
                $fl=true;
                break;
            }
        }

        if ($fl ==false) 
        {
            $tag = new Tag();
                $tag->name   = $request->name;
                $tag->state  = ($request->state == 1) ? 1 : 0; 
            $tag->save(); 
            return redirect()->route('tags.index')->with('status', 'El registro se cargo correctamente.');
        }
        else        
            return redirect()->route('tags.create')->with('status', 'La categoría ya existe.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        $tag = Tag::find($tag->id);

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $request->validate([
            'name'  => 'required',
        ]);

        $tag = Tag::find($tag->id);
            $tag->name  = $request->name;
            $tag->state = ($request->state == 1) ? 1 : 0; 
        $tag->update(); 

        return redirect()->route('tags.index')->with('status', 'El registro se modifico correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        $tag->delete();

        return redirect()->route('tags.index')->with('status', 'El registro se elimino correctamente.');
    }
}
