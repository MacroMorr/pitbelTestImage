<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePitbel extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $fillable = [
        'user_id',
        'name',
    ];
    /**
     * @var mixed|string
     */
    public mixed $addImage;
}
