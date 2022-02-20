<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $req = parent::toArray($request);
        $response = [];

        if (array_key_exists("user", $req)) {
            $response['author'] = [
                "name" => $req['user']['name'],
                "email" => $req['user']['email'],
            ];
        }
        return array_merge($response, [
            "id" => $req['id'],
            "title" => $req['title'],
            "body" => $req['body'],
            "visibility" => !!$req['visibility'],
            "created" => $req['created_at'],
            "last_modified" => $req['updated_at']
        ]);
    }
}
