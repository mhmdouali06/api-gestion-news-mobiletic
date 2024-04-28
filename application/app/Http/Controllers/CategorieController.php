<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Resources\CategorieResource;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nom' => ['required', 'string'],
            'parent_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $categorie = Categorie::create($request->all());

        return response()->json(['message' => 'Category created successfully', 'data' => $categorie], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $name)
    {   
        $categorie=Categorie::where('Nom', $name)->with("children","news")->first();
        if($categorie){
            
        $data= new CategorieResource($categorie) ;
        return response()->json($data, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);

    }

   
}
