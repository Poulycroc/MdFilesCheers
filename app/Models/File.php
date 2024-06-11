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

    const VISIBILITY_PRIVATE = 0;
    const VISIBILITY_PUBLIC = 1;

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
        'folder_id',
        'project_id',
    ];

    protected $groupable_models = [
        User::class,
    ];

    /**
     * @return array Adventure visibility enums
     */
    public static $visibilityEnums = [
        self::VISIBILITY_PRIVATE => 0,
        self::VISIBILITY_PUBLIC => 1,
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


    /**
     * Generate the full path for the file.
     *
     * @return string
     */
    public function getPathAttribute()
    {
        $path = $this->name;
        if ($this->folder) {
            $path = $this->folder->getPathAttribute() . '/' . $path;
        }
        if ($this->project) {
            $path = $this->project->name . '/' . $path;
        }
        return $path;
    }

    /**
     * Find a file by its path.
     *
     * @param string $path
     * @return File|null
     */
    public static function findByPath($path)
    {
        $segments = explode('/', $path);
        $fileName = array_pop($segments);
        $query = self::where('name', $fileName);

        $project = null;
        $folder = null;

        foreach ($segments as $segment) {
            if (!$project) {
                $project = Project::where('name', $segment)->first();
                if ($project) {
                    $query->where('project_id', $project->id);
                }
            } elseif (!$folder) {
                $folder = Folder::where('name', $segment)->where('project_id', $project->id)->first();
                if ($folder) {
                    $query->where('folder_id', $folder->id);
                }
            } else {
                $folder = Folder::where('name', $segment)->where('parent_id', $folder->id)->first();
                if ($folder) {
                    $query->where('folder_id', $folder->id);
                }
            }
        }

        return $query->first();
    }
}
