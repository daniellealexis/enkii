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
     * @return \App\ListComment[]
     */
    public function index($listId)
    {
        return ListComment::with('commentOwner:id,username')
            ->where('list_id', $listId)
            ->get();
    }

    /**
     * Get ListComment by id.
     *
     * @param  int  $commentId
     * @return \App\ListComment
     */
    public function getComment($commentId)
    {
        return ListComment::with('commentOwner:id,username')
            ->where('id', $commentId)
            ->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ListCommentStoreRequest  $request
     * @param  int $listId
     * @return \Illuminate\Http\Response
     */
    public function store(ListCommentStoreRequest $request, $listId)
    {
        $list = Lists::where('id', $listId)->firstOrFail();

        $comment = new ListComment($request->all());
        $comment->user_id = Auth::id();
        $comment->ip_address = $request->getClientIp();

        $list->comments()->save($comment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ListCommentUpdateRequest  $request
     * @param  int  $commentId
     * @return \Illuminate\Http\Response
     */
    public function update(ListCommentUpdateRequest $request, $commentId)
    {
        $comment = ListComment::where('id', $commentId)->firstOrFail();
        $comment->update($request->all());
        $comment->ip_address = $request->getClientIp();
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\ListCommentDeleteRequest $request
     * @param  int  $commentId
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListCommentDeleteRequest $request, $commentId)
    {
        $comment = ListComment::where('id', $commentId)->firstOrFail();
        $comment->delete();
    }
}
