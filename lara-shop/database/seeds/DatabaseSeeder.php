<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('products')->insert([
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 2, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ],
            ['catalog_id' => 1, 'product_name' => str_random(9),'price' => random_int(1,100000),'description' => 'anh hUng nha', 'view' =>random_int(1,1200), 'brand' => 'puma','status' =>1 ]
        ]);


    }
}
