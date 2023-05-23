<?php

namespace App\Models;


use App\Models\Traits\Likable;
use Hekmatinasser\Verta\Verta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory,Likable;

    protected $fillable=['user_id', 'body',
    ];
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtInHumanAttribute()
    {
        return (new Verta($this->created_at))->formatDifference();
    }


}
