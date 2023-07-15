<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = ExperienceResource::collection(Experience::all());
        return Inertia::render("Experiences/Index", compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Experiences/Create");
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
                "title" => "required | min:3 | max:255",
                "description" => "required",
                "image" => "required | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
                "start_date" => "required",
                "end_date" => "required",
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('experiences');
                Experience::create([
                    "title" => $request->title,
                    "description" => $request->description,
                    "image" => $image,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
                ]);

                return Redirect::route('experiences.index');
            }

            return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        return Inertia::render("Experiences/Edit", compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experience $experience)
    {
        $image = $experience->image;

        if ($request->hasFile('image')) {
            Storage::delete($image);
            $image = $request->file('image')->store('experiences');
        }

        $experience->update([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $image,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
        ]);

        return Redirect::route('experiences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        Storage::delete($experience->image);
        $experience->delete();

        return Redirect::route('experiences.index');
    }
}
