<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsGroupable;
use App\Traits\IsGroup;

class Project extends Model
{
    use HasFactory;
    use IsGroup;
    use IsGroupable;

    protected $table = 'projects';
    protected $fillable = [
        'name',
        'visibility',
    ];

    protected $groupable_models = [
        User::class,
    ];
}
