<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
