<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    protected $attributes = [
        'done' => false,
    ];

    public static function deleteImage($image)
    {
        if (Storage::exists("/public/images/$image")) {
            Storage::delete("/public/images/$image");

        } else {
            dd('File does not exist.');
        }
    }
}
