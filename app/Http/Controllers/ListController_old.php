<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Session;
use JavaScript;
use Illuminate\Http\Request;
use App\Http\User;
use App\Lists;
use App\ListItem;
use Illuminate\Support\Facades\Validator;

// use user to get editable fields?

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'cat rackham';
    }

    public function createNewList()
    {
        $list = new Lists();
        $list->save();

        return $response()->json(
            compact($list)
        );
    }

    public function getListById($id)
    {
        $list = Lists::find($id);
        $list['list_items'] = ListItem::where('list_id', $id);

        return response()->json(
            compact($list)
        );
    }

    public function updateList($id)
    {
        $user = Auth::user();

        if (!Auth::check() || $this->_checkIfUserHasAccessToList($user->id, $id)) {
            abort(403);
        }
    }

    public function deleteList($id)
    {
        $user = Auth::user();

        if (!Auth::check() || $this->_checkIfUserHasAccessToList($user->id, $id)) {
            abort(403);
        }

        Lists::destroy($id);

        return response();
    }

    private function _checkIfUserHasAccessToList($userId, $listId)
    {
        $list = Lists::find($listId);
        return ($list->user_id === $userId);
    }
}
