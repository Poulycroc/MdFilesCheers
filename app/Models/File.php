<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsGroupable;

class File extends Model
{
    use HasFactory;
    use IsGroupable;

    protected $table = 'files';

    protected $groupable_models = [
        User::class,
    ];

    protected $fillable = [
        'name',
        'size',
        'author_id',
    ];
}
