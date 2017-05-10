<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'content' => 'esto es un comentario 1'
        ]);

        DB::table('comments')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'content' => 'esto es un comentario 2'
        ]);

        DB::table('comments')->insert([
            'branch_office_id' => 2,
            'client_id' => 3,
            'content' => 'esto es un comentario 3'
        ]);

        DB::table('comments')->insert([
            'branch_office_id' => 2,
            'client_id' => 3,
            'content' => 'esto es un comentario 4'
        ]);
    }
}
