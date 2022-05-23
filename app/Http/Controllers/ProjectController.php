<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Sections;
use Validator;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * show index 
     *
     */

    public function index(Project $project)
    {
        $projects = Project::with('tasks')->orderBy('id', 'desc')->get();
       return view('/home', compact('projects'));
    }

    public function indexa(Project $project)
    {
        $projects = Project::with('tasks')->find($project->id);
        
       return view('project' , compact('projects'));
    }

 /**
     * store() create project.
     *
     
     */
    public function create(Project $projects)
    {
        return view('/home', compact('projects'));

    }

    public function store(Request $request)
    {
        $project = request()->validate([
            'name' => 'required',
            'description' => 'required',
         [
            'name' => 'Please give project name',
            'description' => 'Please give project description',
         ]

        ]);
        auth()->user()->projects()->create($project);

            if($project) {
                return back()->with('success', 'Project Created successfully');
            }else {
                return back()->with('error', 'Something went wrong.Please try again');
            }
    }

     /**
     * update() Update project 
     *
     *
     */
    public function edit(Project $projects)
    {
        return view('/project/{project}', compact('projects'));

    }
  
    public function update(Request $request , $project)
    {
        $message = [
            'name.required' => 'Please give project name',
            'description.required' => 'Please give project description',
            'user_id' => 'required'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], $message)->validate();
        $project = Project::find($project);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        $project->status = $request->status;
        $project->save();
        if($project) {
            return back()->with('success', 'Project Updated successfully');
        }else {
            return back()->with('error', 'Something went wrng.Please try again');
        }
        
    }

     /**
     * Delete project by id with it tasks.
     *
     * @param Request $request
     * @param integer $id
     * @return response
     */

    public function delete(Project $project)
    {
        $project = Project::find($project->id);
        $project->tasks()->delete();
        $project->delete();
        if($project) {
            return redirect('/home')->with('success', 'Project Deleted successfully');
        }else {
            return back()->with('error', 'Something went wrong.Please try again');
        }
    }


   
    //
}
