<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

use Sections;
use Validator;

class TaskController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    
     /**
     * show index 
     *
     */


    public function index(Task $task)
    {
        $tasks = Task::orderBy('priority', 'asc')->get();

       return view('/tasks', compact('tasks'));
    }

    
    public function indexa(Task $task)
    {
        $tasks = Task::with('project')->find($task->id);
        
       return view('/tasks' , compact('tasks'));
    }

    
 /**
     * store() create tasks.
     *
     
     */

    public function create(Task $tasks)
    {
        return view('/tasks', compact('tasks'));

    }

    public function store(Request $request)
    {
        
        $message = [
            'name.required' => 'Please give project name',
            'description.required' => 'Please give project description',
           
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'priority' => '',
            'status' => '',
            
        ], $message)->validate();
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->status = 0;
        $task->save();
        if($task) {
            return back()->with('success', 'Task Created successfully');
        }else {
            return back()->with('error', 'Something went wrng.Please try again');
        }
    }

    /**
    * update() Update Task 
    *
    *
    */

    public function edit(Task $tasks)
    {
        return view('/tasks', compact('tasks'));

    }
  
    public function update(Request $request)
    {
        $message = [
            'name' => 'Please give project name',
            'description' => 'Please give project description',
            
        ];
        $validator = Validator::make($request->all(), [
            'name' => '',
            'description' => '',    
            'priority' => '',
            'status' => '',

        ], $message)->validate();
        $task = Task::where('id', $request->id)->first();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->status = 0;
        $task->save();

        if($task) {
            return back()->with('success', 'Task Updated successfully');
        }else {
            return back()->with('error', 'Something went wrng.Please try again');
        }

    }

    /**
     * update  tasks priority.
     *
     * 
     */

        public function updatePriority(Request $request)
        {

            $tasks = Task::all();

            foreach ($tasks as $task) {
                foreach ($request->priority as $priority) {
                    if ($priority['id'] == $task->id) {
                        $task->update(['priority' => $priority['position']]);
                    }
                }
            }

        }

        /**
     * Delete Tasks.
     *
     * 
     */

    public function delete(Request $request)
    {
        $task = Task::where('id', $request->id)->first();
        $task->delete();
        if($task) {
            return back()->with('success', 'Task Deleted successfully');
        }else {
            return back()->with('error', 'Something went wrng.Please try again');
        }
    }


    

   

    //
}
