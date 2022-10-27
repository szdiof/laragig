<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //  \App\Models\User::factory(6)->create();

    $user = User::factory()->create([
        'name' => 'Abdulrazack',
        'email' => 'suleshy@gmail.com'
    ]);

     Listing::factory(6)->create([
        'user_id' => $user->id
     ]);

     
    //  Listing::create(

    //     [
    //         'title' => 'Cool staff',
    //         'tags'  => '@szdiof',
    //         'company' => 'Laragigs Company',
    //         'Location' => 'Arusha',
    //         'email' => 'szdiof@gmail.com',
    //         'website' => 'www.laragigs.com',
    //         'description' => 'It is always good and blessing to be part of this greate and amazing society'
    //         ]
        
    // );

    // Listing::create(

    //     [
    //         'title' => 'Laravel Application',
    //         'tags'  => '@Suleshy',
    //         'company' => 'Computer an Maintainance Company',
    //         'Location' => 'Arusha',
    //         'email' => 'szdiof@gmail.com',
    //         'website' => 'www.laragigs.com',
    //         'description' => 'We are the solution regarding every computer problem'
    //         ]
        
    // );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
