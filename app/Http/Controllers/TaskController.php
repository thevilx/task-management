<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // we can use paginate here but its just a simple test
        $tasks = Task::orderBy('priority')->get();

        return view('tasks' , compact('tasks'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        try{
            Task::create([
                'name' => $request->name,
                'priority' => Task::orderBy('priority' , 'desc')->first()->priority + 1,
            ]);
        }
        catch(Exception $e){
            Alert::error('Error' , 'Something went wrong');
            return redirect()->back();
        }

        Alert::success('Successful' , 'Task Created Successfully.');
        return back();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('edit_task' , compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        try{
            $task->update([
                'name' => $request->name,
            ]);
        }catch(Exception $e){
            Alert::error('Error' , 'Task Update Failed.');
            return back();
        }


        Alert::success('Successful' , 'Task Updated Successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try{
            $task->delete();
        }
        catch(Exception $e){
            Alert::error('Error' , 'Task Cannot Be Deleted.');
            return back();
        }

        Alert::success('Successful' , 'Task Deleted Successfully.');

        return back();
    }
}
