<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\Article\Article as ArticleResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $limit = ($request->has('_limit')) ? $request->get('_limit') : 10;
        $articles = Article::filterBy($request)->with('user')->paginate($limit);
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleStoreRequest $request
     * @return ArticleResource|Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $validatedArticle = $request->validated();
        $article = new Article($validatedArticle);
        if ($article->save()) {
            return new ArticleResource($article->load('user'));
        }

        return new Response(["message" => "error creating article"], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ArticleResource|Response
     */
    public function show($id)
    {
        $error = new Response(["message" => "article not found"], 404);
        if (!is_numeric($id)) return $error;
        try {
            $article = Article::with("user")->findOrFail($id);
            return new ArticleResource($article);
        } catch (ModelNotFoundException $e) {
            return $error;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param int $id
     * @return ArticleResource|Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $toUpdate = $request->validated();
        $error = new Response(["message" => "error updating article"], 500);
        if (!is_numeric($id)) return $error;
        try {
            $article = Article::findOrFail($id);
            if ($article->update($toUpdate)) return new ArticleResource($article->load('user'));
        } catch (\Exception $exception) {
            return $error;
        }
        return $error;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $error = new Response(["message" => "error deleting article"], 500);
        if (!is_numeric($id)) return $error;
        if (Article::where('id', $id)->delete()) {
            return new Response(["message" => "article deleted"], 200);
        };
        return $error;
    }
}
