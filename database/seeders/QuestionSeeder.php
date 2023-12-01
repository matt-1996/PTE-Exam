<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use File;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(__DIR__ . "/questions.json");
        $questions = json_decode($json);

        foreach ($questions as $question) {
            question::create([
                'name' => $question->name,
                'body' => $question->body,
                'type' => $question->type,
            ]);
        }
    }
}
