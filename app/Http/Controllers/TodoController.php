<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Session::has('todos')) {
            Session::put('todos', [
                'Eat breakfast',
                'Go to the gym',
                'Learn Laravel',
                'Go to office',
                'Go to office',
                'Return home',
                'Sleep',
                'Repeat',
            ]);
        }

        $todos = Session::get('todos') ?? [];
        return view('todo.index', [
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // get csrf token
        // $csrf = $request->session()->token();

        // dd(csrf_token(), $csrf);

        $todos = Session::get('todos') ?? [];
        $todos[] = $request->todo;
        Session::put('todos', $todos);

        return redirect()->route('todo.index')->with('success', 'Todo added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($key)
    {
        $todo = '';
        $todos = Session::get('todos') ?? [];
        if (isset($todos[$key])) {
            $todo = $todos[$key];
        }
        return view('todo.index', [
            'todos' => $todos,
            'todo' => $todo,
            'key' => $key,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $key)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($key)
    {
        $todos = Session::get('todos', []);
        if (isset($todos[$key])) {
            unset($todos[$key]);
            Session::put('todos', $todos);
        }

        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully');
    }
}
