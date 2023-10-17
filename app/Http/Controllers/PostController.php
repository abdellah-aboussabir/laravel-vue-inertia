<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Traits\GeneraleTrait;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

            return  inertia('Post/Listing', [
                'posts' => $postsData->original,
                'title' => "Posts"
            ]);

        }catch (ClientException $ex){
            return self::returnError(500, "Error occurred", $ex);
        }
    }


    /**
     * Display the specified resource.
     * @param Request $request
     * */
    public function show(Request $request)
    {
        try {
            $PostID = null;
            $id = $request->id;

            $postID = Post::find($id);
            if (!$postID) {
                $postID = $this->returnData("data", [], 404, "No post with id : $id found");
            }
            $postID = $this->returnData("data", $postID, 200, "Post with id : $id selected");

            return inertia('Post/Show', [
                'postID' => $postID,
                'title' => "Show post id"
            ]);
        } catch (ClientException $ex) {
            return self::returnError(500, "Error occurred", $ex);
        }
    }


    /**
     * Display the new post form
     *
     */
    public function create()
    {
        return Inertia::render('Post/Create', [
            'title' => 'Create New Post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $isUserIdExist = UserController::show($validatedData['user_id']);

            if ($isUserIdExist->data) {
                $newPost = new Post();
                $newPost->user_id = $validatedData['user_id'];
                $newPost->title = $validatedData['title'];
                $newPost->content = $validatedData['content'];

                if (!$newPost->save()) {
                    return self::returnError(500, 'Error Occurred', "Not Saved");
                }

                return self::returnSuccessMessage(200, "Post created");
            }

            return self::returnError(500, "Error occurred", "user_id not found");

        } catch (ClientException $ex) {
            return self::returnError(500, "Error occurred", $ex);

        }
    }

    /**
     * Display the post edit
     */
    public function edit(Request $request)
    {
        return Inertia::render('Post/Edit', [
            'id' => $request->id
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param UpdatePostRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        try {
            $postID = self::show($id);
            if (!$postID->original['data']) {
                self::returnError(500, "Post with id :$id not found", null);
            }
            $validatedData = $request->validated();

            $postID->title = $validatedData['title'];
            $postID->content = $validatedData['content'];

            if (!$postID->update()) {
                return self::returnError(500, 'Error Occurred', "Not Saved");
            }

            return self::returnSuccessMessage(200, "Post updated");

        } catch (ClientException $ex) {
            return self::returnError(500, "Error occurred", $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $postID = $this->show($id);
            if (!$postID->data) {
                return self::returnError(404, "No post with id : $id to delete", null);
            }
            if (!$postID->data->delete()) {
                return self::returnError(404, "Post not deleted", null);
            }

            return self::returnSuccessMessage(200, "Post deleted");

        } catch (ClientException $ex) {
            return self::returnError(500, "Error occurred", $ex);

        }
    }

}
