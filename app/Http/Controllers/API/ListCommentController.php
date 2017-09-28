<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListCommentDeleteRequest;
use App\Http\Requests\ListCommentStoreRequest;
use App\Http\Requests\ListCommentUpdateRequest;
use App\ListComment;
use App\Lists;
use Illuminate\Support\Facades\Auth;


class ListCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'store',
            'update',
            'destroy',
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Lists $list
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Lists $list)
    {
        return $list->comments()->with('commentOwner:id,username')->get();
    }

    /**
     * Get ListComment by id.
     *
     * @param  \App\ListComment  $comment
     * @return \App\ListComment
     */
    public function getComment(ListComment $comment)
    {
        return $comment->load('commentOwner:id,username');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ListCommentStoreRequest  $request
     * @param  \App\Lists $list
     * @return \Illuminate\Http\Response
     */
    public function store(ListCommentStoreRequest $request, Lists $list)
    {
        $comment = new ListComment($request->all());
        $comment->user_id = Auth::id();
        $comment->ip_address = $request->getClientIp();

        $list->comments()->save($comment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ListCommentUpdateRequest  $request
     * @param  \App\ListComment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(ListCommentUpdateRequest $request, ListComment $comment)
    {
        $comment->update($request->all());
        $comment->ip_address = $request->getClientIp();
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\ListCommentDeleteRequest $request
     * @param  \App\ListComment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListCommentDeleteRequest $request, ListComment $comment)
    {
        $comment->delete();
    }
}
