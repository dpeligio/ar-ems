<?php

use Illuminate\Database\Seeder;
use App\Models\Configuration\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::insert([
            ['year_level' => 1, 'stage' => 'secondary', 'name' => 'Section A'],
            ['year_level' => 1, 'stage' => 'secondary', 'name' => 'Section B'],
            ['year_level' => 1, 'stage' => 'secondary', 'name' => 'Section C'],
            ['year_level' => 2, 'stage' => 'secondary', 'name' => 'Section A'],
            ['year_level' => 2, 'stage' => 'secondary', 'name' => 'Section B'],
            ['year_level' => 2, 'stage' => 'secondary', 'name' => 'Section C'],
            ['year_level' => 3, 'stage' => 'secondary', 'name' => 'Section A'],
            ['year_level' => 3, 'stage' => 'secondary', 'name' => 'Section B'],
            ['year_level' => 3, 'stage' => 'secondary', 'name' => 'Section C'],
            ['year_level' => 4, 'stage' => 'secondary', 'name' => 'Section A'],
            ['year_level' => 4, 'stage' => 'secondary', 'name' => 'Section B'],
            ['year_level' => 4, 'stage' => 'secondary', 'name' => 'Section C'],
            ['year_level' => 4, 'stage' => 'secondary', 'name' => 'Section C'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'Section A'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'Section B'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'ICT A'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'ICT B'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'STEM A'],
            ['year_level' => 5, 'stage' => 'secondary', 'name' => 'STEM B'],
            ['year_level' => 6, 'stage' => 'secondary', 'name' => 'ICT A'],
            ['year_level' => 6, 'stage' => 'secondary', 'name' => 'ICT B'],
            ['year_level' => 6, 'stage' => 'secondary', 'name' => 'STEM A'],
            ['year_level' => 6, 'stage' => 'secondary', 'name' => 'STEM B'],
            ['year_level' => 1, 'stage' => 'tertiary', 'name' => 'CITCS 1A'],
            ['year_level' => 1, 'stage' => 'tertiary', 'name' => 'CITCS 1B'],
            ['year_level' => 1, 'stage' => 'tertiary', 'name' => 'CITCS 1C'],
            ['year_level' => 2, 'stage' => 'tertiary', 'name' => 'CITCS 2A'],
            ['year_level' => 2, 'stage' => 'tertiary', 'name' => 'CITCS 2B'],
            ['year_level' => 2, 'stage' => 'tertiary', 'name' => 'CITCS 2C'],
            ['year_level' => 3, 'stage' => 'tertiary', 'name' => 'CITCS 3A'],
            ['year_level' => 3, 'stage' => 'tertiary', 'name' => 'CITCS 3B'],
            ['year_level' => 3, 'stage' => 'tertiary', 'name' => 'CITCS 3C'],
            ['year_level' => 4, 'stage' => 'tertiary', 'name' => 'CITCS 4A'],
            ['year_level' => 4, 'stage' => 'tertiary', 'name' => 'CITCS 4B'],
            ['year_level' => 4, 'stage' => 'tertiary', 'name' => 'CITCS 4C'],
        ]);
    }
}
