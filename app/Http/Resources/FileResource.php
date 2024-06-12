<?php

namespace App\Http\Resources;

use App\Traits\ContentPublishing\Status as PublishStatus;
use Illuminate\Http\Resources\Json\JsonResource;
// use App\Models\File;
use App\Models\User;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $file = $this->resource;

        return (array) [
            'id' => (string) $file->id,
            'name' => (string) $file->name,
            'size' => $file->size,
            'content' => $file->content,
            'status' => (string) $this->getStatus($file->status),
            'public' => (bool) $this->isPublic($file->visibility),
            'folder_id' => $file->folder_id,
            'project_id' => $file->project_id,
            'author' => MemberResource::make(User::findOrFail($file->author_id)),
            'created_at' => $file->created_at,
            'updated_at' => $file->updated_at,
            'path' => $file->getPathAttribute(),
        ];

        // return collect($data);
    }

    public function getStatus(int $status = 5): string
    {
        $publishStatus = new PublishStatus();
        return $publishStatus->getStatus($status);
    }


    /**
     * Check if the file is public.
     *
     * @param int $visibility
     * @return bool
     */
    public function isPublic(int $visibility = 0): bool
    {
        return $visibility === 1;
    }
}
