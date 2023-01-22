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
        $gangas = Ganga::paginate(10);
        return view('ganga.index', compact('gangas'));
    }

    public function news()
    {
        $gangas = Ganga::orderBy('created_at', 'desc')->paginate(10);
        return view('ganga.index', compact('gangas'));
    }

    public function highlights()
    {
        $gangas = Ganga::orderBy('likes', 'desc')->paginate(10);
        return view('ganga.index', compact('gangas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::get();
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
        request()->validate(
            [
                'title' => 'required|min:3',
                'description' => 'required|min:3',
                'url' => 'required',
                'price' => 'required',
                'price_sale' => 'required',
                'category' => 'required',
            ],[
                'title.required' => 'El título es obligatorio',
                'title.min' => 'El título debe de tener como minimo 3 caracteres',
                'description.required' => 'La descripcion es obligatorio',
                'description.min' => 'La descripcion debe de tener como minimo 50 caracteres',
                'url.required' => 'La url es obligatorio',
                'price.required' => 'El precio es obligatorio',
                'price_sale.required' => 'El precio rebajado es obligatorio',
                'category.required' => 'La categoria es obligatoria',
            ]
        );
        //Guardamos los datos de la ganga
        $ganga = new Ganga();
        $ganga->title= $request->get('title');
        $ganga->description= $request->get('description');
        $ganga->url= $request->get('url');
        $ganga->price= $request->get('price');
        $ganga->price_sale= $request->get('price_sale');
        $ganga->user_id = $request->get('user_id');
        $ganga->category = $request->get('category');

        $ganga->save();

        //Recuperamos la ganga guardada mediante su id:
        $id = $ganga->id;
        $img = $request->file('img');
        $path = $img->storeAs('img', $id . '-ganga-severa.'. $img->getClientOriginalExtension(), 'public');

        $ganga->img = $path;
        $ganga->save();

        $gangas = Ganga::paginate(10);;
        return view('ganga.index', compact('gangas', 'path'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ganga = Ganga::with('category')->find($id);
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
            $ganga = Ganga::with('category')->find($id);
            return view('ganga.edit', compact('ganga', 'categorys'));
        }
        $gangas = Ganga::orderBy('title', 'asc')->paginate(10);
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

        return view('ganga.show', compact('ganga'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkAdminOrOwner($id);
        $ganga = Ganga::find($id);
        $ganga->delete();
        $gangas = Ganga::orderBy('title', 'asc')->paginate(10);
        return view('ganga.index', compact('gangas'));
    }

    public function checkAdminOrOwner($id){
        $ganga = Ganga::find($id);
        if((Auth::user()->id) === ($ganga->user_id)){
            return true;
        }else{
            return false;
        }
    }

    public function thumbUp($id){
        if(Auth::check()){
            $ganga = Ganga::find($id);
            $ganga->increment('likes', 1);
            $ganga->save();
            $this->index();
        }else{
            $this->index();
        }
    }

    public function thumbDown($id){
        if(Auth::check()){
            $ganga = Ganga::find($id);
            $ganga->increment('unlikes', 1);
            $ganga->save();
            $this->index();
        }else{
            $this->index();
        }
    }
}
