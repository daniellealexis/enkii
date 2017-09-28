<?php

namespace App\Http\Requests;

use App\ListComment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListCommentDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check())
            return false;

        $id = $this->route('comment');

//        $count = ListComment::join('lists', 'lists.id', 'list_comments.list_id')
//            ->where(['list_comments.user_id' => Auth::id(), 'list_comments.id' => $id])
//            ->orwhere(['lists.user_id' => Auth::id(), 'list_comments.id' => $id])
//            ->count();

//        $count = ListComment::with('parentList:id,user_id')
//            ->where(['list_comments.user_id' => Auth::id(), 'list_comments.id' => $id])
//            ->orwhere(['lists.user_id' => Auth::id(), 'list_comments.id' => $id])
//            ->count();

        //TODO: look into using Gates with this instead
        $comment = ListComment::where('id', $id)->firstOrFail();
        if ($comment->user_id != Auth::id())
            return false;

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
