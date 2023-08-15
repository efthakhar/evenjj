<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public $events = [
        [
            'title' => 'WordCamp Chittagong 2024',
            'description' => '',
            'date' => '2024-12-12',
            'time' => '9:0:0',
            'location' => 'Chittagong Club, KazirDewri',
            'created_by' => 1,
            'event_category_id' => 4,
        ],
        [
            'title' => 'laracon Dhakah 2023',
            'description' => '',
            'date' => '2023-12-10',
            'time' => '10:0:0',
            'location' => 'Radison Water Garden, Dhaka',
            'created_by' => 1,
            'event_category_id' => 4,
        ],
    ];

    public function run(): void
    {
        foreach ($this->events as $e) {
            Event::create($e);
        }
    }
}
