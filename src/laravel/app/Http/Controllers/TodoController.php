<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    private $todo; // 追記

    public function __construct(Todo $todo)
    {
        $this->todo = $todo; // 追記
    }

    public function index()
    {
   // 以下に変更
        $todos = $this->todo->all();

        return view('todo.index', ['todos' => $todos]);
    }
    
    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();
    
        $this->todo->fill($inputs); // 変更
        $this->todo->save(); // 変更
    
    
        return redirect()->route('todo.index');
    }

    public function show($id)
    {
           // 以下に変更
    $todo = $this->todo->find($id);
    return view('todo.show', ['todo' => $todo]);
    }
    
    public function edit($id)
    {
    // 編集対象のレコードを取得
    $todo = $this->todo->find($id);

    // 編集画面にデータを渡す
    return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        // ②モデルに値をセットする前？
        $todo->fill($inputs);
        // ③DBに保存する直前？
        $todo->save();
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
    // TODO: 削除対象のレコードの情報を持つTodoモデルのインスタンスを取得
    $todo = $this->todo->find($id);
    $todo->delete();
    return redirect()->route('todo.index');
    }



}