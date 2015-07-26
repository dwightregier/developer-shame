<?php

use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badges')->insert(['title' => 'Shameful',
            'description' => 'You created your first post on Developer Shame. Congratulations, you\'re one of us now!',
            'icon' => '<i class="fa fa-shirtsinbulk fa-5x fa-fw"></i>']);

        DB::table('badges')->insert(['title' => 'Talkative',
            'description' => 'You commented for the first time. Congratulations, no one is going to listen to you.',
            'icon' => '<i class="fa fa-comment fa-5x fa-fw"></i>']);

        DB::table('badges')->insert(['title' => 'That was Bad',
            'description' => 'Congratulations, your story was so shameful someone followed your post.',
            'icon' => '<i class="fa fa-badges-plus fa-5x fa-fw"></i>']);

        DB::table('badges')->insert(['title' => 'You Suck',
            'description' => 'You are not the only one who thought your code is dumb, someone besides yourself upvoted your shame.',
            'icon' => '<i class="fa fa-arrow-up fa-5x fa-fw"></i>']);

        DB::table('badges')->insert(['title' => 'Platinum',
            'description' => 'Wow, you got all of the badges you can get. Maybe you should go outside, or maybe learn to write better code.',
            'icon' => '<i class="fa fa-sun-o fa-5x fa-fw"></i>']);
    }
}
