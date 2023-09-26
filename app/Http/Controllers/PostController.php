<?php

namespace App\Http\Controllers;

use App\Http\Requests\Common\PaginationRequest;
use App\Http\Traits\GeneraleTrait;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use GeneraleTrait;
    /**
     * @param Pagination $request
     * Display a listing of the resource.
     *@return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        try {
            // $validatedData = $request->validated();

            $posts = Post::paginate(5);
            if(!$posts){
                return $this->returnData("data",[],404, "No posts found");
            }
            $postsData =   $this->returnData("data", $posts, 200, "Posts selected" );
            $test = [
                [
                    "id" => 1,
                    "user_id" => 1,
                    "title" => "title-post",
                    "content" => "title-content"
                ],
                [
                    "id" => 2,
                    "user_id" => 2,
                    "title" => "another-title",
                    "content" => "another-content"
                ],

            ];
            return  inertia('Post/Listing', [
                'posts' => $postsData->original,
                'title' => "Posts"
            ]);

        }catch (ClientException $ex){
            return self::returnError(500, "Error occurred", $ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
