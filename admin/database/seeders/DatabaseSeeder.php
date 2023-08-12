<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        // Tags
        $this->call(TagSeeder::class);

        $this->call(FileSeeder::class);
    	// $img 			 = new File();
	    // 	$img->title 	 = 'img 1';
	    // 	$img->url_size_1 = 'img 1';
	    // 	$img->url_size_2 = 'img 11';
	    // 	$img->tag_id 	 = 1;
	    // 	$img->user_id 	 = 1;
	    // 	$img->state 	 = 1;
    	// $img->save();

    	



    }
}
