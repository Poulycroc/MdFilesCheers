<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsGroupable;

class Folder extends Model
{
    use HasFactory;
    use IsGroupable;

    protected $table = 'folders';
    protected $fillable = ['name'];

    protected $groupable_models = [User::class];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
