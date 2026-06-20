<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UIBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Banner Block
        \App\Models\UIBlock::create([
            'title' => 'Welcome to the Next-Gen Digital Platform',
            'type' => 'banner',
            'content' => 'Unlock unprecedented productivity and design excellence. Build dynamic interfaces, manage components dynamically, and launch beautiful pages with zero friction.',
            'status' => true,
            'display_order' => 1,
        ]);

        // 2. Stats Block
        \App\Models\UIBlock::create([
            'title' => 'Our Core Performance Metrics',
            'type' => 'stats',
            'content' => json_encode([
                ['number' => '99.99%', 'label' => 'Server Uptime'],
                ['number' => '250M+', 'label' => 'API Requests/Day'],
                ['number' => '15k+', 'label' => 'Global Customers'],
                ['number' => '< 50ms', 'label' => 'Average Response Time']
            ]),
            'status' => true,
            'display_order' => 2,
        ]);

        // 3. Card Block
        \App\Models\UIBlock::create([
            'title' => 'Features That Empower You',
            'type' => 'card',
            'content' => json_encode([
                [
                    'title' => 'Extremely Customizable',
                    'text' => 'Tailor every component to match your unique brand identity with deep modular blocks.',
                    'icon' => 'bi-sliders'
                ],
                [
                    'title' => 'Enterprise Security',
                    'text' => 'Bank-grade security protocols, automatic threat detection, and encrypted data structures.',
                    'icon' => 'bi-shield-lock'
                ],
                [
                    'title' => 'Realtime Analytics',
                    'text' => 'Track your conversions, active sessions, and engagement with our native live dashboards.',
                    'icon' => 'bi-graph-up-arrow'
                ]
            ]),
            'status' => true,
            'display_order' => 3,
        ]);

        // 4. List Block
        \App\Models\UIBlock::create([
            'title' => 'Frequently Asked Questions & Guidelines',
            'type' => 'list',
            'content' => 'Zero-downtime deployment workflows, Comprehensive API reference and tutorials, Integrated visual block builder, Native localization and multi-language support, Automated image and asset optimization pipelines',
            'status' => true,
            'display_order' => 4,
        ]);
    }
}
