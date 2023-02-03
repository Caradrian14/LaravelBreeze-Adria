<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GangaCollection;
use App\Http\Resources\GangaResource;
use App\Models\Ganga;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class GangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/gangas",
     *     summary="Listar todas las gangas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todas las gangas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ganga")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error al listar las gangas"
     *     )
     * )
     */
    public function index()
    {
        return new GangaCollection(\App\Models\Ganga::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ganga = new Ganga();
        $ganga->title= $request->title;
        $ganga->description= $request->description;
        $ganga->url= $request->url;
        $ganga->price= $request->price;
        $ganga->price_sale= $request->price_sale;
        $ganga->user_id = $request->user_id;
        $ganga->category_id = $request->category_id;
        $ganga->img = $request->img;

        //Recuperamos la ganga guardada mediante su id:
        try {
            $ganga->save();
            return response()->json($ganga, 201);
        }catch (QueryException $e){
            return response()->json([$e->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function show(Ganga $ganga)
    {
        return new GangaResource($ganga);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ganga $ganga)
    {
        //$this->checkAdminOrOwner($ganga->id);
        $ganga = Ganga::find($ganga->id);
        $ganga->title= $request->get('title');
        $ganga->description= $request->get('description');
        $ganga->url= $request->get('url');
        $ganga->price= $request->get('price');
        $ganga->price_sale= $request->get('price_sale');
        $ganga->user_id = $request->get('user_id');
        $ganga->category_id = $request->get('category_id');
        $ganga->update();
        return response()->json($ganga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ganga $ganga)
    {
        //$this->checkAdminOrOwner($ganga->id);
        $ganga = Ganga::find($ganga->id);
        $ganga->delete();
        return response()->json($ganga);
    }

    public function checkAdminOrOwner($id){
        $ganga = Ganga::find($id);
        if((Auth::user()->id) === ($ganga->user_id)){
            return true;
        }else{
            return false;
        }
    }
}
