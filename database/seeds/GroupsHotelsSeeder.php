<?php

use Illuminate\Database\Seeder;

class GroupsHotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $groups = [
            [
                'uuid' => 'e544da92-c453-4b3b-8e09-b6066a58f5ee',
                'name' => 'GHL',
                'description' => 'Es un grupo Hotelero con mas de 34 Hoteles en 16 ciudades de Colombia',
                'logo' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '07053c19-e35f-4638-a4a1-35d92b5e1f9c',
                'name' => 'HILTON',
                'description' => 'Grupo Hotelero cuenta con 20 hoteles en Colombia ',
                'logo' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '464d3ab4-5557-4a25-8c78-129b801f6aad',
                'name' => 'HOTELES ESTELAR',
                'description' => ' 26 Hoteles en Colombia, en total 3.074 habitaciones. ',
                'logo' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ];

        \DB::table('hotels_groups')
            ->insert($groups);
    }
}
