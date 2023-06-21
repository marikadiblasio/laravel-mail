<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $projects = Project::paginate(3);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     */
    public function store(StoreProjectRequest $request)
    {
        $data=$request->validated();
        $slug=Str::slug($data['name'], '-');
        $data['slug']=$slug;
        if($request->hasFile('image')){
            $image_path= Storage::put('uploads', $request->image);
            $data['image']=asset('storage/' . $image_path);
        }
        $project = Project::create($data);

        if($request->has('technologies')){
            $project->tecnologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data=$request->validated();
        $slug=Str::slug($data['name'], '-');
        $data['slug']=$slug;
        if($request->hasFile('image')){
            if($project->image){ //se esiste immagine precedente
                $toRemove="http://127.0.0.1:8000/storage/";//aggiusta il path
                $imagetoRemove=str_replace($toRemove, '', $project->image);
                Storage::delete($imagetoRemove);//cancellala
            }
            $image_path= Storage::put('uploads', $request->image);
            $data['image']=asset('storage/' . $image_path);
        }
        $project->update($data);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }else{
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroy(Project $project)
    {
        if($project->image){ //se esiste immagine precedente
            $toRemove="http://127.0.0.1:8000/storage/";//aggiusta il path
            $imagetoRemove=str_replace($toRemove, '', $project->image);
            Storage::delete($imagetoRemove);//cancellala
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "{$project->name} deleted");
    }
}
