<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = config('db.technologies');

        foreach ($technologies as $value) {
            $newTechnology = new Technology();

            $newTechnology->name = $value['title'];
            $newTechnology->slug = Str::slug($newTechnology->name, '-');

            $newTechnology->save();
        }
    }
}
