<?php

namespace Database\Seeders;

use App\Models\EventCategory as ModelsEventCategory;
use Illuminate\Database\Seeder;

class EventCategory extends Seeder
{
    public $eventCategories = [
        ['id' => 1, 'name' => 'food & drinks', 'slug' => 'food-and-drinks'],
        ['id' => 2, 'name' => 'cycling', 'slug' => 'cycling'],
        ['id' => 3, 'name' => 'travel', 'slug' => 'travel'],
        ['id' => 4, 'name' => 'developer community', 'slug' => 'developer-community'],
        ['id' => 5, 'name' => 'programming', 'slug' => 'programming'],
        ['id' => 6, 'name' => 'study abroad', 'slug' => 'study-abroad'],
        ['id' => 7, 'name' => 'sports', 'slug' => 'sports'],
        ['id' => 8, 'name' => 'business', 'slug' => 'business'],
        ['id' => 9, 'name' => 'health', 'slug' => 'health'],
    ];

    public function run(): void
    {
        foreach ($this->eventCategories as $cat) {
            ModelsEventCategory::create($cat);
        }
    }
}
