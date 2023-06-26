<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTechnologiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for($i = 0; $i < 70; $i++){
      $project = Project::inRandomOrder()->first();

      $technology_id = Technology::inRandomOrder()->first()->id;

      // $check_project = Project::find($project->id)->toArray();

      $check_project = DB::table('project_technology')
        ->where('project_id', $project->id)
        ->where('technology_id', $technology_id)
        ->count();

      if (!$check_project) {
        $project->technologies()->attach($technology_id);
      }

      // if(array_key_exists('technologies', $check_project)){
      //   if(!in_array($technology_id, $check_project['technologies'])){
      //       $project->technologies()->attach($technology_id);
      //     }
      //   }
      // }

    }
  }
}
