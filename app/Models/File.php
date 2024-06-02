<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Traits\IsGroupable;

class File extends Model
{
    use HasFactory;
    use IsGroupable;

    protected $table = 'files';
    protected $fillable = [
        'name',
        'size',
        'author_id',
        'content',
        'size',
        'status',
        'visibility',
        'encrypted_passcode',
    ];

    protected $groupable_models = [
        User::class,
    ];

    /**
     * Encrypt the passcode before storing it in the database.
     */
    public function setPasscodeAttribute(string $value): void
    {
        $this->attributes['encrypted_passcode'] = Crypt::encryptString($value);
    }

    /**
     * Decrypt the passcode when retrieving it from the database.
     */
    public function getPasscodeAttribute(): string
    {
        return Crypt::decryptString($this->attributes['encrypted_passcode']);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
