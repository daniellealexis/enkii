<?php

namespace App;

use App\ListItem;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image_url', 'type'
    ];

    private $validationRules = [
        'title' => 'string|required',
        'description' => 'nullable|string',
        'image_url' => 'nullable|url',
        'type' => 'string|in:ol,ul'
    ];

    protected static function boot()
    {
        parent::boot();

        // Cascade delete related models
        static::deleting(function ($lists) {
            $lists->listItems()->delete();
            $lists->comments()->delete();
        });
    }

    public function createValidator($data)
    {
        return Validator::make($data, $this->validationRules);
    }

    public function getById($id)
    {
        return this::find($id);
    }

    public function listItems()
    {
        return $this->hasMany('App\ListItem', 'list_id');
    }

    public function comments()
    {
        return $this->hasMany('App\ListComment', 'list_id');
    }

    public function create()
    {
        // create new list row
        // return id
    }

    public function updateList()
    {
        // nyeh
    }

    public function delete()
    {
        // Delete list and list items
    }
}
