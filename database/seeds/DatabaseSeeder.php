<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'info@soundeducation.nl',
            'password' => Hash::make('Wonderwall2018'),
        ]);

        DB::table('teachers')->insert([
            'name' => 'teacher',
            'email' => 'teacher@teacher.nl',
            'color' => '#ffffff',
            'password' => Hash::make('Wonderwall2018'),
        ]);

        DB::table('schoolgroups')->insert([
            'title' => 'd20',
        ]);

        DB::table('students')->insert([
            'name' => 'student',
            'email' => 'student@student.nl',
            'schoolgroup_id' => 1,
            'password' => Hash::make('Wonderwall2018'),
        ]);
    }
}
