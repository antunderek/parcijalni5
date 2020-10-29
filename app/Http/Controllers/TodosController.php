<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Database\Eloquent\Collection;

class TodosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todos = Todo::where('owner', Auth::id())->get();
        return view('pages.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todo = new Todo;

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->owner = Auth::id();

        $todo->save();
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $todo = Todo::find($id);
        if (($todo === null) || !$this->checkIfOwner($todo)) {
            return abort(404);
        }
        return view('pages.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        if (($todo === null) || !$this->checkIfOwner($todo)) {
            return abort(404);
        }
        return view('pages.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $todo = Todo::find($id);
        if (($todo === null) || !$this->checkIfOwner($todo)) {
            return abort(404);
        }
        $todo->title = $request->title;
        $todo->description = $request->description;
        
        if ($request->completed == "completed") {
            $todo->completed = true;
        }
        else {
            $todo->completed = false;
        }
        
        $todo->save();
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todoDelete = Todo::find($id);
        //if (($todoDelete === null) || !$this->checkIfOwner($todo)) {
         //   return abort(404);
        //}
        $todoDelete->delete();
        return redirect()->route('todo.index');
    }

    private function checkIfOwner(Todo $todo)
    {
        return $todo->owner === Auth::id();
    }
}
