<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'url', 'content', 'thumbnail', 'author_id', 'category_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function getThumbnailPath()
    {
        // Gantilah 'thumbnail' dengan nama kolom thumbnail pada model Anda
        return public_path('article_images/') . $this->thumbnail;
    }
}