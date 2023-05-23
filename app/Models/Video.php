<?php

namespace App\Models;

use App\Filters\VideoFilters;
use App\Models\Traits\Likable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory, Likable, SoftDeletes;

    protected $hidden = ['category_id',
    ];

    protected $appends = ['owner_name'];

    protected $perPage = 18;

    protected $fillable = ['name', 'path', 'thumbnail', 'slug', 'length', 'description', 'category_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getLengthInHumanAttribute()
    {
        return gmdate("i:s", $this->length);
    }

    public function getcreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference(\verta());
    }

    public function relatedVideos(int $count = 6)
    {
        return $this->category->getRandomVideos($count, $this->id)->load('user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }


    public function getVideoUrlAttribute()
    {
        return '/' . $this->path;
    }

    public function getVideoThumnailAttribute()
    {

        return '/storage/' . $this->thumbnail;
    }


    public function scopeFilter(Builder $builder, array $params)
    {

        return (new VideoFilters($builder))->apply($params);


    }

    public function scopeSort(Builder $builder, array $params)
    {


    }
}
