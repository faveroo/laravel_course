<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use App\Service\Operations;

class MainController extends Controller
{
    public function home()
    {
        $id = session('user')->id;
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', compact('notes'));
    }

    public function createNote()
    {
        return view('new-note');
    }

    public function storeNote(Request $request)
    {
        $request->validate([
            'text_title' => 'required|min:3|max:100',
            'text_note' => 'required|min:3|max:3000',
        ], [
            'text_title.required' => 'O campo título é obrigatório',
            'text_title.min' => 'O título deve ter no mínimo :min caracteres',
            'text_title.max' => 'O título deve ter no máximo :max caracteres',
            'text_note.required' => 'O campo texto é obrigatório',
            'text_note.min' => 'A nota deve ter no mínimo :min caracteres',
            'text_note.max' => 'A nota deve ter no máximo :max caracteres',
        ]);

        $id = session('user')->id;

        $note = new Note();
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->user_id = $id;
        $note->save();

        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        $note = Note::find($id);

        return view('edit-note', compact('note'));
    }

    public function updateNote(Request $request)
    {
        $request->validate([
            "text_title" => "required|min:3|max:100",
            "text_note" => "required|min:3|max:3000",
        ], [
            "text_title.required" => "O campo título é obrigatório",
            "text_title.min" => "O título deve ter no mínimo :min caracteres",
            "text_title.max" => "O título deve ter no máximo :max caracteres",
            "text_note.required" => "O campo texto é obrigatório",
            "text_note.min" => "A nota deve ter no mínimo :min caracteres",
            "text_note.max" => "A nota deve ter no máximo :max caracteres",
        ]);

        if (!$request->has('id')) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->id);
        $note = Note::findOrFail($id);

        if (!$note) {
            return redirect()->route('home');
        }

        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
    }
}
