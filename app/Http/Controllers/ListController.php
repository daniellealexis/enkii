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

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            // redirect to login page
            // flash that they need to have an account to do that
        }

        $list = new Lists();

        $list->user_id = Auth::user()->id;

        $list->save();

        return redirect()->route('lists.edit', ['id' => $list->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->checkCurrentUserAccessToList($id)) {
            abort(403);
        }

        $list = $this->getListWithListItems($id);

        JavaScript::put(compact($list));

        return view('pages.list-edit', $list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->checkCurrentUserAccessToList($id)) {
            abort(403);
        }

        // get list
        // validate request info
        // split out and save list items
        // save list
        // send back flash message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->checkCurrentUserAccessToList($id)) {
            abort(403);
        }

        Lists::destroy($id);
        // destroy list_items with list_id as well, unless laravel handles it?
        // make it do that otherwise

        return response();
    }

    public function getListWithListItems($id)
    {
        $list = Lists::find($id);
        $list['list_items'] = ListItem::where('list_id', $id);
        return $list;
    }

    /**
     * Checks if the currently logged-in user has access to the list
     *
     * @param  int  $listId
     * @return boolean
     */
    public function checkCurrentUserAccessToList($listId)
    {
        $user = Auth::user();
        return (Auth::check() && $this->_checkIfUserHasAccessToList($user->id, $listId));
    }

    /**
     * Checks if the user has access to the list
     *
     * @param  int  $userId
     * @param  int  $listId
     * @return boolean
     */
    private function _checkIfUserHasAccessToList($userId, $listId)
    {
        $list = Lists::find($listId);
        return ($list->user_id === $userId);
    }
}
