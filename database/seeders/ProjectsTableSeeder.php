<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $projects = config('projects');

    foreach ($projects as $project){
      $new_project = new Project();
      $new_project->title = $project['title'];
      $new_project->type_id = Type::inRandomOrder()->first()->id;
      $new_project->description = $project['description'];
      $new_project->slug = Project::generateSlug($new_project->title);
      $new_project->start_date = $project['start_date'];
      $new_project->end_date = $project['end_date'];
      $new_project->commits = $project['commits'];
      $new_project->finished = $project['finished'];
      $new_project->save();
    }
  }
}
