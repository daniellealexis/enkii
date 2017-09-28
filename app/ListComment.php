<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ListComment extends Model
{
    protected $fillable = [
        'comment',
    ];

    protected $hidden = [
        'ip_address',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function parentList()
    {
        return $this->belongsTo('App\Lists', 'list_id');
    }

    public function commentOwner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
