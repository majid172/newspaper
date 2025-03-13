<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'author_id',
        'placement_id',
        'shoulder',
        'headline',
        'hanger',
        'url_title',
        'video_code',
        'thumbnail',
        'thumbnail_caption',
        'description',
        'keywords',
        'tags',
        'division_id',
        'district_id',
        'upazila_id',
        'total_hit',
        'order_id',
        'display_order_id',
        'home_page_visibility',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'home_page_visibility' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }

    public function creator()
    {
        return $this->belongsTo(Author::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Author::class, 'updated_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function details()
    {
        return $this->hasOne(ArticleDetails::class);
    }

    public function photos()
    {
        return $this->hasMany(ArticlePhotos::class);
    }

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('l, F j, Y g:i A');
    }


}
