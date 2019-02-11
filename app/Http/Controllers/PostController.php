<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * @var BaseModel The primary model associated with this controller
     */
    public static $model = Post::class;

    /**
     * @var BaseModel The parent model of the model, in the case of a child rest controller
     */
    public static $parentModel = null;

    /**
     * @var null|BaseTransformer The transformer this controller should use, if overriding the model & default
     */
    public static $transformer = null;


    public function getAll()
    {
        $model = new static::$model;

        $query = $model::with($model::$localWith);
        $this->qualifyCollectionQuery($query);

        $resources = $query->get();
        return $this->response->collection($resources, $this->getTransformer());
    }
}
