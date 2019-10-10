<?php

use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $ghl_id = \DB::table('hotels_groups')
            ->where('uuid', 'e544da92-c453-4b3b-8e09-b6066a58f5ee')
            ->first()
            ->id;
        $hilton_id = \DB::table('hotels_groups')
            ->where('uuid', '07053c19-e35f-4638-a4a1-35d92b5e1f9c')
            ->first()
            ->id;
        $stellar_id = \DB::table('hotels_groups')
            ->where('uuid', '464d3ab4-5557-4a25-8c78-129b801f6aad')
            ->first()
            ->id;

        $hotels = [
            [
                'uuid' => 'bdfd5477-718e-4f42-8cca-b339afd8d051',
                'group_hotel_id' => $ghl_id,
                'name' => 'Hotel GHL Bogota',
                'address' => 'Carrea 10 # 10-10',
                'image' => '',
                'city' => 'Bogota',
                'starts' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '7f2c2d5a-4c9a-436f-b6f3-cc79571b89ac',
                'group_hotel_id' => $ghl_id,
                'name' => 'Hotel GHL Bogota',
                'address' => 'Calle 68 # 68-68',
                'image' => '',
                'city' => 'Bogota',
                'starts' => 5,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '071f175d-76ee-421c-8cb5-c9473eb94040',
                'group_hotel_id' => $hilton_id,
                'name' => 'Hotel Hilton',
                'address' => 'Parque de la 93',
                'image' => '',
                'city' => 'Bogota',
                'starts' => 5,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '522bfb93-555d-4795-9dd3-069a3656f827',
                'group_hotel_id' => $hilton_id,
                'name' => 'Hotel Hilton',
                'address' => 'CARRERA 7 NO. 72-41',
                'image' => '',
                'city' => 'Bogota',
                'starts' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '56685371-10e0-4528-894d-179940749430',
                'group_hotel_id' => $hilton_id,
                'name' => 'Hotel Hilton',
                'address' => 'Avenida Almirante Brion, Carrera 1, El Laguito, Laguito, 130015',
                'image' => '',
                'city' => 'Cartagena de Indias',
                'starts' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => '6a1883c7-75da-4315-a55c-9bf5170768bc',
                'group_hotel_id' => $hilton_id,
                'name' => 'Hilton 53',
                'address' => 'Carrera 53, Calle 100-86',
                'image' => '',
                'city' => 'Barranquilla',
                'starts' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'uuid' => 'b8058418-e362-482d-b64b-9b5c9eae1a0c',
                'group_hotel_id' => $stellar_id,
                'name' => 'Hotel Stellar',
                'address' => 'Cra 1 No 11-116',
                'image' => '',
                'city' => 'Cartagena de Indias',
                'starts' => 4,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ];

        \DB::table('hotels')
            ->insert($hotels);
    }
}
