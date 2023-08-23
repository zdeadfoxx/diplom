<?php

namespace App\Http\Controllers\Text;

use App\Http\Controllers\Controller;
use App\Models\Text\TextModel;
use App\Models\User;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(){
        $user = auth()->user();
        $userTexts = $user->texts()->paginate(12);
        return view('text.index', compact('userTexts'));
    }


    public function store(Request $request){
        $user = auth()->user();


        // Проверка, что пользователь существует

            $validatedData = $request->validate([
                'text' => 'string'
            ]);

            // Создание записи текста
            $text = TextModel::create($validatedData);

            // Получение текущего аутентифицированного пользователя

            // Связывание данных через смежную таблицу
            $user->texts()->attach($text->id);

            return redirect()->route('text.index');



    }

    public function show($id){
        $find_text = TextModel::findOrFail($id);
        return view('text.edit',compact('find_text'));
    }

    public function update($id){
        $find_text = TextModel::findOrFail($id);

        $data = request()->validate([
            'text'=> 'string'
        ]);
        $find_text->update($data);
        return redirect()->route('text.index', ['text' => $find_text->id]);
    }

    public function delete($id){
        $find_text = TextModel::findOrFail($id);

        // Разрываем связи с пользователями через смежную таблицу
        auth()->user()->texts()->detach($find_text->id);

        $find_text->delete(); // Удаляем запись из таблицы texts
        return redirect()->route('text.index');
    }
}
