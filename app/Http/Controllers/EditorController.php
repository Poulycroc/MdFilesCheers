<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Repositories\FileRepository;

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
     * @param string $path
     * @return \Inertia\Response
     */
    public function show(string $path)
    {
        $allFilesTree = $this->fileRepository::all();
        $file = $this->fileRepository::findByPath($path);

        return Inertia::render('Editor', [
            'allFilesTree' => $allFilesTree,
            'file' => $file,
            'path' => $path,
        ]);
    }


    public function storeFile(Request $request)
    {
        dd($request->all());
        $file = $this->fileRepository::store($request->all());

        return redirect()->route('editor.show', $file->path);
    }
}
