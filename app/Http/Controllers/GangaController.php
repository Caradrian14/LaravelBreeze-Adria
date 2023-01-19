<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ganga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class gangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gangas = Ganga::all();
        return view('ganga.index', compact('gangas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        return view('ganga.store', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*request()->validate(
            [
                'title' => 'required|min:2',
                'description' => 'required|min:5',
            ],[
                'title.required' => 'El título es obligatorio',
                'title.min' => 'El título debe de tener como minimo 3 caracteres',
                'Contingut.required' => 'El Contenido es obligatorio',
                'Contingut.min' => 'El contenido debe de tener como minimo 50 caracteres',
            ]
        );*/
        $ganga = new Ganga();
        $ganga->title= $request->get('title');
        $ganga->description= $request->get('description');
        $ganga->url= $request->get('url');
        $ganga->price= $request->get('price');
        $ganga->price_sale= $request->get('price_sale');
        $ganga->user_id = $request->get('user_id');
        $ganga->category = $request->get('category');
        $ganga->save();
        $gangas = Ganga::orderBy('title', 'asc')->paginate(5);
        return view('ganga.index', compact('gangas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ganga = Ganga::find($id);
        return view('ganga.show', compact('ganga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->checkAdminOrOwner($id)){
            $categorys = Category::all();
            $ganga = Ganga::find($id);
            return view('ganga.edit', compact('ganga', 'categorys'));
        }
        $gangas = Ganga::orderBy('title', 'asc')->all();
        return view('ganga.index', compact('gangas'));
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
        $this->checkAdminOrOwner($id);
        $ganga = Ganga::find($id);
        $ganga->title= $request->get('title');
        $ganga->description= $request->get('description');
        $ganga->url= $request->get('url');
        $ganga->price= $request->get('price');
        $ganga->price_sale= $request->get('price_sale');
        $ganga->user_id = $request->get('user_id');
        $ganga->category = $request->get('category');
        $ganga->save();

        $gangas = Ganga::all();
        return view('ganga.index', compact('gangas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkAdminOrOwner($id){
        $ganga = Ganga::find($id);
        if(Auth::user()->id === $ganga->user_id){
            return true;
        }else{
            return false;
        }
    }
}
