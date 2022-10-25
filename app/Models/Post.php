<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'posts';

    protected $primaryKey ='post_id';

    protected $fillable = [
        'user_name',
        'google_id',
        'content',
    ];
}
