<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            ['id' => 1, 'content' => '商品のお届けについて'],
            ['id' => 2, 'content' => '商品の交換について'],
            ['id' => 3, 'content' => '商品トラブル'],
            ['id' => 4, 'content' => 'ショップへのお問い合わせ'],
            ['id' => 5, 'content' => 'その他'],
        ];
        DB::table('categories')->insert($param);
    }
}
