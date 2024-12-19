<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Seller();
        $obj->name = "Seller";
        $obj->email = "seller@gmail.com";
        $obj->password = Hash::make("1234567890");
        $obj->save();
    }
}
