<?php

namespace Database\Factories;

use App\Models\UIBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UIBlock>
 */
class UIBlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['banner', 'card', 'list', 'stats'];
        $type = $this->faker->randomElement($types);

        $content = '';
        switch ($type) {
            case 'banner':
                $content = $this->faker->paragraph(3);
                break;
            case 'card':
                $cards = [
                    ['title' => 'Feature One', 'text' => 'This is a description for feature one. It is highly optimized and easy to use.', 'icon' => 'bi-lightning-charge'],
                    ['title' => 'Feature Two', 'text' => 'This is a description for feature two. Secure, scalable and reliable.', 'icon' => 'bi-shield-check'],
                    ['title' => 'Feature Three', 'text' => 'This is a description for feature three. Reach global audiences instantly.', 'icon' => 'bi-globe']
                ];
                $content = json_encode($cards);
                break;
            case 'list':
                $content = implode(', ', $this->faker->words(5));
                break;
            case 'stats':
                $stats = [
                    ['number' => '99%', 'label' => 'Uptime Guarantee'],
                    ['number' => '10K+', 'label' => 'Active Clients'],
                    ['number' => '24/7', 'label' => 'Dedicated Support']
                ];
                $content = json_encode($stats);
                break;
        }

        return [
            'title' => $this->faker->words(3, true),
            'type' => $type,
            'content' => $content,
            'status' => true,
            'display_order' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
