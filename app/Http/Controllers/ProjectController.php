<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectResource::collection(Project::all());
        return Inertia::render('Projects/Index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all();
        return Inertia::render("Projects/Create", compact('skills'));
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
            "name" => "required | min:3 | max:255",
            "image" => "required | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
            "skill_id" => "required",
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image')->store('projects');
            Project::create([
                "name" => $request->name,
                "image" => $image,
                "link" => $request->project_url,
                "skill_id" => $request->skill_id,
            ]);

            return Redirect::route('projects.index');
        }

        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $skills = Skill::all();
        return Inertia::render("Projects/Edit", compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $image = $project->image;

        $request->validate([
            "name" => "required | min:3 | max:255",
            "image" => "nullable | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
            "skill_id" => "required",
        ]);

        if($request->hasFile('image')) {
            Storage::delete($image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            "name" => $request->name,
            "image" => $image,
            "link" => $request->project_url,
            "skill_id" => $request->skill_id,
        ]);

        return Redirect::route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();

        return Redirect::route('projects.index');
    }
}
