<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FileRepository;

class EditorController extends Controller
{
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function saveContent(Request $request, string $fileId)
    {
        $this->fileRepository->updateContent(
            $fileId,
            $request->input('content')
        );

        return response()->json(['status' => 'success']);
    }
}
