<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use App\Functions\Helper;
use App\Models\Type;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->name = $faker->word();
            $new_project->slug = Helper::generateSlug($new_project->name, Project::class);
            $new_project->short_description = $faker->sentence();
            $new_project->description = $faker->paragraph();
            $new_project->start_project = $faker->date();
            $new_project->end_project = $faker->date();
            $new_project->url = 'https://github.com/MassimoAzzini/heroes-collection';
            $new_project->save();
        }
    }
}
