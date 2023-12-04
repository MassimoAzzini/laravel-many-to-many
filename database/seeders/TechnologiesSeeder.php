<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $data = [
            [
                'name'=>'HTML',
                'link'=>'https://developer.mozilla.org/en-US/docs/Web/HTML'
            ],
            [
                'name'=>'CSS',
                'link'=>'https://developer.mozilla.org/en-US/docs/Web/CSS'
            ],
            [
                'name'=>'JavaScript',
                'link'=>'https://developer.mozilla.org/en-US/docs/Web/JavaScript'
            ],
            [
                'name'=>'PHP',
                'link'=>'https://www.php.net/'
            ],
            [
                'name'=>'Laravel',
                'link'=>'https://laravel.com/docs/10.x'
            ],
            [
                'name'=>'VueJs',
                'link'=>'https://vuejs.org/guide/introduction.html'
            ]
        ];
        foreach($data as $technology){
        $new_technology = new Technology();
        $new_technology->name = $technology['name'];
        $new_technology->slug = Str::slug($technology['name'], '-');
        $new_technology->link = $technology['link'];
        $new_technology->save();
        }

    }
}
