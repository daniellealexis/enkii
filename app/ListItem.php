<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'list_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'resource_url', 'description', 'image_url', 'index'
    ];

    private $validationRules = [
        'title' => 'string|required_if:resource_url,null',
        'resource_url' => 'nullable|url',
        'description' => 'nullable|string',
        'image_url' => 'nullable|url',
        'index' => 'numeric'
    ];

    public function createValidator($data)
    {
        return Validator::make($data, $this->validationRules);
    }

    public function parentList()
    {
        return $this->belongsTo('App\Lists', 'list_id');
    }
}
