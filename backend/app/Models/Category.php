<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name',
        'title',
        'parent_id',
        'header_display',
        'menubar_display',
        'status',
        'keyword',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'header_display' => 'boolean',
        'menubar_display' => 'boolean',
        'status' => 'boolean',
    ];

    // Define the relationship to itself (parent-child)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    // Define relationships to User (if using created_by, updated_by, deleted_by)
    // public function createdBy() { ... }
    // public function updatedBy() { ... }
    // public function deletedBy() { ... }
}
