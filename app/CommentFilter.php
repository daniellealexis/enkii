<?php

namespace App;

use App\Framework\Utilities\Filters;
use Illuminate\Database\Eloquent\Model;

class CommentFilter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'plain_text',
    ];

    public function setPlainTextAttribute($value)
    {
        $value = strtolower(rtrim($value));
        $this->attributes['plain_text'] = $value;
        $this->attributes['filter'] = Filters::generateFilter($value);
    }
}
