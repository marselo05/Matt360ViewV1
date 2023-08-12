<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Tag::factory(5)->create();
        $tag1 = new Tag();
            $tag1->name     = 'imagen';
            $tag1->state    = 0;
        $tag1->save();

        $tag2 = new Tag();
            $tag2->name     = 'video';
            $tag2->state    = 0;
        $tag2->save();

        $tag3 = new Tag();
            $tag3->name     = '2D';
            $tag3->state    = 0;
        $tag3->save();
    }
}
