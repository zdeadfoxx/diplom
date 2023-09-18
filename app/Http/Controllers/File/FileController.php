<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File\File AS FileModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;




class FileController extends Controller
{
    public function index(){
        $user = auth()->user();
        $userFiles = $user->files()->paginate(7);
        return view('file.index', compact('userFiles'));
    }

    public function create(Request $request)
    {
    $request ->validate([
        'file'=>'required|max:1e+6'
    ]);

    // Получение информации о файле
    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $filePath = $file->storeAs('uploads', $fileName, 'public');
    $fileType = $file->getClientMimeType();
    $fileSize = $file->getSize();

    // Создание и сохранение модели файла
    $fileModel = new FileModel();
    $fileModel->name = $fileName;
    $fileModel->file_path = $filePath;
    $fileModel->Size = $fileSize;
    $fileModel->Mine = $fileType;
    $fileModel->save();

    // Получение текущего аутентифицированного пользователя
    $user = auth()->user();

    // Связывание данных через смежную таблицу
    $user->files()->attach($fileModel->id);

    try {
        return response()->json(['success' => true, 'payload' => 'My message']);
    } catch (\Exception $e) {
        // Обработка ошибки, например, возврат сообщения об ошибке
        return redirect()->back()->with('error', 'Ошибка при сохранении файла');
    }
    }


    public function download($id)
    {
       $files = DB::table('files')->where('id',$id)->first();
       $path = Storage::path("public/$files->file_path");
       return response()->download($path);
    }

    public function delete($id) {
        $userFiles = FileModel::findOrFail($id);
        auth()->user()->files()->detach($userFiles->id);
        $userFiles->delete();
        return redirect()->route('file.index', compact('userFiles'));
    }


}
