<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Book; 

class Category extends Model
{
    protected $fillable = ['nama_kategori'];
}