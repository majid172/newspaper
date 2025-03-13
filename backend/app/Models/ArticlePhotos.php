<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePhotos extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'image',
        'image_caption',
        'status',
        'created_by',
        'updated_by',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function creator()
    {
        return $this->belongsTo(Author::class, 'created_by');
    }
}
