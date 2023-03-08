<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('db.categories');

        for ($i=0; $i < sizeof($data); $i++) { 
            $newType = new Type();

            $newType->name = $data[$i]['title'];
            $newType->slug = Str::slug($newType->name, '-');

            $newType->save();
        }
    }
}
