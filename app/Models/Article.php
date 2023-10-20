<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function Writer()
    {
        return $this->hasMany(Article::class, 'writer_id');
    }
}
