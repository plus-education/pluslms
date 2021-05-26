<?php

namespace NovaModules\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'library_books';

    public function author()
    {
        return $this->belongsTo(Author::class,'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'library_book_category', 'book_id', 'category_id');
    }
}
