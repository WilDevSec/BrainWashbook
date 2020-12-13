<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()-hasPosts(3)->hasComments(10)->count(5)->create();
    }
}
