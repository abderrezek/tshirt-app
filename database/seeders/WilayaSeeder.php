<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilayas = [
            ['name' => "Adrar", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Chlef", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Laghouat", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Oum El Bouaghi", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Batna", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Bejaia", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Biskra", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Béchar", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Blida", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Bouira", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tamanrasset", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tébessa", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tlemcen", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tiaret", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tizi Ouzou", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Alger", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Djelfa", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Jijel", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Sétif", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Saïda", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Skikda", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Sidi Bel Abbes", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Annaba", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Guelma", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Constantine", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Medea", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Mostaganem", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "M'Sila", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Mascara", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Ouargla", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Oran", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "El Bayadh", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Illizi", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Bordj Bou Arreridj", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Boumerdes", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "El Tarf", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tindouf", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tissemsilt", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "El Oued", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Khenchela", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Souk Ahras", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Tipaza", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Mila", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Aïn Defla", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Naama", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Aïn Temouchent", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Ghardaia", 'created_at' => now(), 'updated_at' => now(),],
            ['name' => "Relizane", 'created_at' => now(), 'updated_at' => now(),],
        ];
        Wilaya::insert($wilayas);
    }
}
