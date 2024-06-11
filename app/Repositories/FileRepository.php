<?php

namespace App\Repositories;

use App\Repositories\Setters\OwnerSetter;
use App\Traits\ContentPublishing\Status as PublishStatus;
use App\Models\File;

/**
 * FileRepository
 */
class FileRepository extends File
{
    use OwnerSetter;

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

    public function store(array $data): File
    {
        $file = new $this->file();
        $file->name = $data['name'] ?? 'Untitled';
        $file->size = $data['size'] ?? 0;
        $file->content = $data['content'] ?? '# Hello World';

        $file->visibility = $data['visibility'] ?? File::VISIBILITY_PRIVATE;

        $file->folder_id = $data['folder_id'] ?? null;
        $file->project_id = $data['project_id'] ?? null;

        if (!$file->save()) {
            throw new \Exception('Failed to save file');
        }

        if (!self::setCreator($file)) {
            throw new \Exception('Failed to set creator');
        }

        self::setDraftedStatus($file);

        return $file;
    }
}
