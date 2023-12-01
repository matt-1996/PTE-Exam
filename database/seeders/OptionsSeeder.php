<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App\Models\QuestionOption;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $json = File::get(__DIR__ . "/options.json");
        // $options = json_decode($json);

        // foreach ($options as $option) {
        //     QuestionOption::create([
        //         'question_id' => $option->question_id,
        //         'name' => $option->name,
        //         'body' => $option->body,
        //         'type' => $option->type,
        //     ]);
        // }
    }
}
