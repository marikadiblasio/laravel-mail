<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $technologies=Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data=$request->validated();
        $slug=Str::slug($data['name'], '-');
        $data['slug']=$slug;
        $technology = Technology::create($data);
        return redirect()->route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**



     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data=$request->validated();
        $slug=Str::slug($data['name'], '-');
        $data['slug']=$slug;
        $technology->update($data);
        return redirect()->route('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', "{$technology->name} deleted");
    }
}
