<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Repositories\Setters\OwnerSetter;
use App\Repositories\Setters\StatusSetter;
use App\Traits\ContentPublishing\Status as PublishStatus;
use App\Models\File;

/**
 * FileRepository
 */
class FileRepository extends File
{
    use OwnerSetter;
    use StatusSetter;

    private $file;
    private $publishStatus;

    /**
     * Create a new repository instance.
     *
     * @param  File  $file
     */
    public function __construct()
    {
        $this->file = self::class;
        $this->publishStatus = new PublishStatus();
    }

    public function find($id): File
    {
        return $this->file::findOrFail($id);
    }

    public function store(array $data): File
    {
        $file = new $this->file();

        $file->id = Str::uuid();

        $file->name = $data['name'] ?? 'Untitled';
        $file->size = $data['size'] ?? 0;
        $file->content = $data['content'] ?? '# Hello World';

        $file->visibility = $data['visibility'] ?? File::VISIBILITY_PRIVATE;

        $file->folder_id = $data['folder_id'] ?? null;
        $file->project_id = $data['project_id'] ?? null;

        if (!self::setAuthor($file)) {
            throw new \Exception('Failed to set creator');
        }

        if (!$file->save()) {
            throw new \Exception('Failed to save file');
        }

        self::setDraftedStatus($file);

        return $file;
    }
}
