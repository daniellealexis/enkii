<?php

namespace App;

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

    public function createValidator($data)
    {
        return Validator::make($data, $this->validationRules);
    }

    public function getById($id)
    {
        return this::find($id);
    }

    public function create()
    {
        // create new list row
        // return id
    }

    public function updateList()
    {

    }

    public function delete()
    {
        // Delete list and list items
    }
}
