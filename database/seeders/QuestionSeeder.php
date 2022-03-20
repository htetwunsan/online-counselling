<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depression = Speciality::whereName('depression')->first();
        $anxiety = Speciality::whereName('anxiety')->first();
        $stress = Speciality::whereName('stress')->first();
        $relationships = Speciality::whereName('relationships')->first();
        $grief = Speciality::whereName('grief')->first();
        $trauma = Speciality::whereName('trauma')->first();
        $selfesteem = Speciality::whereName('self-esteem')->first();
        $guidance = Speciality::whereName('guidance')->first();
        $anger = Speciality::whereName('anger')->first();

        $q = Question::updateOrCreate(['name' => "I've been feeling depressed."]); //depression
        $q->specialities()->withTimestamps()->syncWithoutDetaching($depression->id);

        $q = Question::updateOrCreate(['name' => "I feel anxious or overwhelmed."]); //anxiety
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($anxiety->id);

        $q = Question::updateOrCreate(['name' => "I've been stressed."]); //stress
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($stress->id);

        $q = Question::updateOrCreate(['name' => "I struggle with building or maintaining relationships."]); //relationships
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($relationships->id);

        $q = Question::updateOrCreate(['name' => "I can't find purpose and meaning in my life."]); //depression, guidance
        $q->specialities()->withTimeStamps()->syncWithoutDetaching([$depression->id, $guidance->id]);

        $q = Question::updateOrCreate(['name' => "I am grieving."]); //grief
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($grief->id);

        $q = Question::updateOrCreate(['name' => "I have experienced trauma."]); //trauma
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($trauma->id);

        $q = Question::updateOrCreate(['name' => "I want to gain self confidence."]); //self-esteem
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($selfesteem->id);

        $q = Question::updateOrCreate(['name' => "I want to improve myself but I don't know where to start."]); //guidance
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($guidance->id);

        $q = Question::updateOrCreate(['name' => "I feel angry often."]); //anger
        $q->specialities()->withTimeStamps()->syncWithoutDetaching($anger->id);
    }
}
