<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::All();
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
            'name' =>'min:3|max:10',
            'age' =>'min:1|max:10',
            'province' =>'nullable'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->province = $request->province;

        $author->save();

        return response()->json(['message' =>'Create', 'Author' => $author], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Author::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'min:3|max:10',
            'age' =>'min:1|max:10',
            'province' =>'nullable'
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->age = $request->age;
        $author->province = $request->province;
        $author->save();

        return response()->json(['message' =>'Update', 'Author' => $author], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Author::destroy($id);
        if($isDeleted == 1) {
            return response()->json(['message' => 'deleted'], 200);
        }else{
            return response()->json(['message' => 'ID NOT FOUND'], 404);
        }
    }
}
