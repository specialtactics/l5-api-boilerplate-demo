<?php

use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Welcome route - link to any public API documentation here
 */
Route::get('/', function () {
    echo 'Welcome to our API';
});


/**
 * @var $api \Dingo\Api\Routing\Router
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['middleware' => ['api']], function (Router $api) {
    /**
     * Authentication
     */
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->group(['prefix' => 'jwt'], function (Router $api) {
            $api->get('/token', 'App\Http\Controllers\Auth\AuthController@token');
        });
    });

    /**
     * Test
     */
    $api->group(['prefix' => 'posts'], function (Router $api) {
        $api->get('/', 'App\Http\Controllers\PostController@getAll');
        $api->post('/', 'App\Http\Controllers\PostController@post');
    });

    $api->group(['prefix' => 'forums'], function (Router $api) {
        $api->get('/', 'App\Http\Controllers\ForumController@getAll');
    });


    /**
     * Authenticated routes
     */
    $api->group(['middleware' => ['api.auth']], function (Router $api) {
        /**
         * Authentication
         */
        $api->group(['prefix' => 'auth'], function (Router $api) {
            $api->group(['prefix' => 'jwt'], function (Router $api) {
                $api->get('/refresh', 'App\Http\Controllers\Auth\AuthController@refresh');
                $api->delete('/token', 'App\Http\Controllers\Auth\AuthController@logout');
            });

            $api->get('/me', 'App\Http\Controllers\Auth\AuthController@getUser');
        });

        /**
         * Users
         */
        $api->group(['prefix' => 'users', 'middleware' => 'check_role:admin'], function (Router $api) {
            $api->get('/', 'App\Http\Controllers\UserController@getAll');
            $api->get('/{uuid}', 'App\Http\Controllers\UserController@get');
            $api->post('/', 'App\Http\Controllers\UserController@post');
            $api->put('/{uuid}', 'App\Http\Controllers\UserController@put');
            $api->patch('/{uuid}', 'App\Http\Controllers\UserController@patch');
            $api->delete('/{uuid}', 'App\Http\Controllers\UserController@delete');
        });

        /**
         * Roles
         */
        $api->group(['prefix' => 'roles'], function (Router $api) {
            $api->get('/', 'App\Http\Controllers\RoleController@getAll');
        });

        /*
         * Forums
         */
        $api->group(['prefix' => 'forums'], function (Router $api) {
            $api->get('/', 'App\Http\Controllers\ForumController@getAll');
            $api->get('/{uuid}', 'App\Http\Controllers\ForumController@get');
            $api->post('/', 'App\Http\Controllers\ForumController@post');
            $api->patch('/{uuid}', 'App\Http\Controllers\ForumController@patch');
            $api->delete('/{uuid}', 'App\Http\Controllers\ForumController@delete');

            /*
             * Topics
             */
            $api->group(['prefix' => '/{forumUuid}/topics'], function ($api) {
                $api->get('/', 'App\Http\Controllers\TopicController@getAll');
                $api->get('/{uuid}', 'App\Http\Controllers\TopicController@get');
                $api->post('/', 'App\Http\Controllers\TopicController@post');
                $api->patch('/{uuid}', 'App\Http\Controllers\TopicController@patch');
                $api->delete('/{uuid}', 'App\Http\Controllers\TopicController@delete');
            });
        });

        /*
         * Topics
         */
        $api->group(['prefix' => 'topics'], function (Router $api) {
            /*
             * Posts
             */
            $api->group(['prefix' => '/{topicUuid}/posts'], function (Router $api) {
                $api->get('/', 'App\Http\Controllers\PostController@getAll');
                $api->get('/{uuid}', 'App\Http\Controllers\PostController@get');
                $api->post('/', 'App\Http\Controllers\PostController@post');
                $api->patch('/{uuid}', 'App\Http\Controllers\PostController@patch');
                $api->delete('/{uuid}', 'App\Http\Controllers\PostController@delete');
            });
        });

        /*
         * PaginatedResources
         */
        $api->group(['prefix' => 'paginated-resources'], function (Router $api) {
            $api->get('/', 'App\Http\Controllers\PaginatedResourceController@getAll');
            $api->get('/{uuid}', 'App\Http\Controllers\PaginatedResourceController@get');
            $api->post('/', 'App\Http\Controllers\PaginatedResourceController@post');
            $api->patch('/{uuid}', 'App\Http\Controllers\PaginatedResourceController@patch');
            $api->delete('/{uuid}', 'App\Http\Controllers\PaginatedResourceController@delete');
        });
    });
});
