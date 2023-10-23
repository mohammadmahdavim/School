<?php

use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateways = [
            'Zarinpal' => [
                'name' => 'زرین پال',
                'slug' => 'Zarinpal',
                'type' => 'online',
                'image' => 'zarinpal.png',
                'config' => json_encode([
                    'merchant' => ''
                ]),
                'default' => 1,
                'active' => 1,
                'wallet' => 0,
                'limit_cost' => 0,
            ]
        ];

        foreach ($gateways as $key=>$gateway){
            $exist = \App\Models\Gateway::where('slug', $key)->first();
            if(!$exist){
                \App\Models\Gateway::create([
                    'name' => $gateway['name'],
                    'slug' => $gateway['slug'],
                    'type' => $gateway['type'],
                    'image' => $gateway['image'],
                    'config' => $gateway['config'],
                    'default' => $gateway['default'],
                    'active' => $gateway['active'],
                    'wallet' => $gateway['wallet'],
                    'limit_cost' => $gateway['limit_cost'],
                ]);
            }
        }

    }
}
