<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Repositories\FileRepository;

use App\Http\Resources\FileResource;

class EditorController extends Controller
{
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }


    //
    public function index()
    {
        return Inertia::render('Editor');
    }

    /**
     * Show the editor view for a file.
     *
     * @param string $fileId
     * @return \Inertia\Response
     */
    public function show(string $fileId)
    {
        $allFilesTree = $this->fileRepository::all();

        $file = $this->fileRepository->find($fileId);
        $fileResource = FileResource::make($file);

        return Inertia::render('Editor', [
            'allFilesTree' => $allFilesTree,
            'file' => $fileResource,
            'path' => $fileResource->path,
        ]);
    }


    public function storeFile(Request $request)
    {
        $file = $this->fileRepository->store($request->all());

        return redirect()->route('editor.show', $file->path);
    }
}
