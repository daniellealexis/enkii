<?php

namespace App\Http\Requests;

use App\ListComment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListCommentUpdateRequest extends FormRequest
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
        return [
            'comment' => 'required|string|max:2048',
        ];
    }
}
