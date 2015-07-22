<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['title' => 'ActionScript']);
        Tag::create(['title' => 'AppleScript']);
        Tag::create(['title' => 'Asp']);
        Tag::create(['title' => 'BASIC']);
        Tag::create(['title' => 'C']);
        Tag::create(['title' => 'C++']);
        Tag::create(['title' => 'Clojure']);
        Tag::create(['title' => 'COBOL']);
        Tag::create(['title' => 'ColdFusion']);
        Tag::create(['title' => 'Erlang']);
        Tag::create(['title' => 'Fortran']);
        Tag::create(['title' => 'Groovy']);
        Tag::create(['title' => 'Haskell']);
        Tag::create(['title' => 'Java']);
        Tag::create(['title' => 'JavaScript']);
        Tag::create(['title' => 'Lisp']);
        Tag::create(['title' => 'Perl']);
        Tag::create(['title' => 'PHP']);
        Tag::create(['title' => 'Python']);
        Tag::create(['title' => 'Ruby']);
        Tag::create(['title' => 'Scala']);
        Tag::create(['title' => 'Scheme']);
    }
}
