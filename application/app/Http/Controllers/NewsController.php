<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::all();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "Titre" => ['required', 'string'],
            "Contenu" => ['required', 'string'],
            "Date_debut" => [ 'date'],
            "Date_fin" => ['required', 'date'],
            "categorie_id" => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $news = News::create($request->all());
        return response()->json(['message' => 'News created successfully', 'data' => $news], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        if ($news) {
            return response()->json($news, 200);
        }
        return response()->json(['message' => 'News not found'], 404);
    }

    /**
     * Display 
     */
    public function dernieres_news(){
        $data=News::where('Date_fin','<=',now())->orderBy('Date_debut','DESC')->get();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            "Titre" => ['string'],
            "Contenu" => ['string'],
            "Date_debut" => ['date'],
            "Date_fin" => ['date'],
            "categorie_id" => ['string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->update($request->all());

        return response()->json(['message' => 'News updated successfully', 'data' => $news], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {

        if ($news) {
            $news->delete();
            return response()->json(['message' => 'News deleted successfully.'],204);}
        return response()->json(['message' => 'News not found'], 404);
    }
}
