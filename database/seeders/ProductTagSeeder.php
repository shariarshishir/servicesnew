<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'Anoraks',
            'Capes',
            'Cloaks',
            'Fur Coats',
            'Jackets',
            'Wind Jackets',
            'Blouses',
            'Caps',
            'Cardigans',
            'Corporate Uniform',
            'Denim',
            'Dress Pant',
            'Flannel Pants',
            'Flannel Shirt',
            'Fleece Jackets',
            'Hooded Sweat Shirt',
            'Jeans',
            'Jerseys',
            'Long Pant',
            'Petticoats',
            'Polo Shirts',
            'Pullovers',
            'Pyjamas',
            'Scarfs',
            'Shirt-Blouses',
            'Shirts',
            'Shorts',
            'Singlets',
            'Skirts Dresses',
            'Sports Wear',
            'Suits',
            'Sweat Shirts',
            'Sweater',
            'Tank Tops',
            'Tops',
            'Track-Suits',
            'Trousers',
            'T-Shirts',

        ];

        foreach($data as $d){
            ProductTag::create(['name' => strtolower($d)]);
        }

    }
}
