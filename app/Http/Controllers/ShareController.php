<?php

namespace App\Http\Controllers;

use App\ListItem;
use App\Lists;
use App\User;


class ShareController extends Controller
{
    /**
     * Show a list of all the user's... umm lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll(User $account)
    {
        //TODO: this is a placeholder, make something amaze-balls for this
        return "Found all lists for user {$account->name}";
    }

    /**
     * Show a specific user's list.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexList(User $account, Lists $list)
    {
        // ensure the requested list belongs to the user in the subdomain
        if ($list->user_id !== $account->id)
            abort(404);

        //TODO: this is a placeholder, make something amaze-balls for this
        return "Found list for user {$account->name}";
    }

    /**
     * Show a specific user's list item.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexItem(User $account, ListItem $item)
    {
        // ensure the requested list item belongs to the user in the subdomain
        if ($item->parentList->user_id !== $account->id)
            abort(404);

        //TODO: this is a placeholder, make something amaze-balls for this
        return "Found list item for user {$account->name}";
    }
}
