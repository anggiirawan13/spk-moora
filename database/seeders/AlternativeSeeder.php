<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AlternativeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $carIds = DB::table('cars')->pluck('id');

        foreach ($carIds as $carId) {
            $alternativeId = DB::table('alternatives')->insertGetId([
                'car_id' => $carId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $criteriaList = DB::table('criterias')->get();

            foreach ($criteriaList as $criteria) {
                $subCriteriaIds = DB::table('sub_criterias')
                    ->where('criteria_id', $criteria->id)
                    ->pluck('id');

                if ($subCriteriaIds->isEmpty()) {
                    continue;
                }

                $subCriteriaId = $faker->randomElement($subCriteriaIds->toArray());

                DB::table('alternative_values')->insert([
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $criteria->id,
                    'sub_criteria_id' => $subCriteriaId,
                    'value' => $faker->numberBetween(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
