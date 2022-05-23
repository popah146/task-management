<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getAll()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return view('/projects/{project}',compact('projects'));
    }

    
    public function create(Project $projects)
    {
        return view('/projects/create', compact('projects'));

    }

    public function store(Request $request)
    {
        $project = request()->validate([
            'name' => 'required',
            'description' => 'required',
         [
            'name.required' => 'Please give project name',
            'description.required' => 'Please give project description',
         ]

        ]);

        auth()->user()->projects()->create(
            $project);

            if($project) {
                return back()->with('success', 'Project Created successfully');
            }else {
                return back()->with('error', 'Something went wrng.Please try again');
            }
           
    }

    public function edit(Project $projects)
    {
        return view('/projects/{projects}', compact('projects'));

    }
  
    public function update(Request $request)
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
        $project = Project::orderBy('id', 'desc')->get();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        $project->status = $request->status;
        $project->save();
        return $project; 
        
    }

}
