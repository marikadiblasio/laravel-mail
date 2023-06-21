<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = config('db.projects');
        foreach($projects as $project){
            $newproject = new Project();
            $newproject->name = $project['name'];
            $newproject->slug = Str::slug($project['name'], '-');
            $newproject->image = $project['image'];
            $newproject->url = $project['url'];
            $newproject->description = $project['description'];
            $newproject->save();
        }
    }
}
