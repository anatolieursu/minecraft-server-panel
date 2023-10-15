<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    use HasFactory;
    protected $fillable = ["button_name", "title", "content", "section", "image_path"];
}
