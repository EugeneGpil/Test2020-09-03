<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Document;

/**
 * generate fake values for document json body
 */
function getFakerValue(Faker $faker, int $loopCount)
{
    $valueTypesArray = [
        'string',
        'integer',
        'float',
        'array',
        'object',
    ];

    /**
     * set type of value
     * if $loopCount >=5 it can't be array or object
     */
    $valueType = $valueTypesArray[
        rand(
            0,
            $loopCount < 5 ? count($valueTypesArray) - 1 : count($valueTypesArray) - 3
        )
    ];

    $loopCount++;

    if ($valueType == 'string') {
        return $faker->text(rand(5, 60));

    } else if ($valueType == 'integer') {
        return $faker->randomNumber();

    } else if ($valueType == 'float') {
        return $faker->randomNumber() / 100;

    } else if ($valueType == 'array') {

        /**
         * Generate array
         * Values may be string, int, float, array, object
         */
        $count = rand(0, 7);
        $array = [];

        for ($i = 0; $i < $count; $i++) {
            $array[$i] = getFakerValue($faker, $loopCount);
        }
        return $array;

    } else if ($valueType == 'object') {

        /**
         * Generate object
         * Values may be string, int, float, array, object
         */
        $keyCount = rand(0, 7);

        $body = [];
    
        for ($i = 0; $i < $keyCount; $i++)
        {
            $body[$faker->text(rand(5, 60))] = getFakerValue($faker, $loopCount);
        }

        return $body;
    }
};

$factory->define(Document::class, function (Faker $faker) {

    $keyCount = rand(0, 7);

    $body = [];

    $isBodyArray = (bool) rand(0, 1);

    // generate array for set document json body
    for ($i = 0; $i < $keyCount; $i++)
    {
        if ($isBodyArray) {
            $body[] = getFakerValue($faker, 0);
        } else {
            $body[$faker->text(rand(5, 60))] = getFakerValue($faker, 0);
        }
    }

    return [
        'title' => $faker->text(rand(5, 60)),
        'body' => json_encode($body),
        'published' => rand(0, 1),
    ];
});
