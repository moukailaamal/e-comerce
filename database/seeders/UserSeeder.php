<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
      
        $user2 = User::create([
            'name' => 'mounkaila',
            'email' => 'admin2@example.com',
            'password' => Hash::make('admin123'),
            'prenom' => 'boubakar',
            'adresse' => 'niger',
            'numero' => '25697524',
            'date_naissance' => '15/12/2000',
            'genre' => 'H',
            'role'=>'admin',
            'profession' => 'developpeur',
        ]);
        $user3 = User::create([
            'name' => 'mounkaila',
            'email' => 'admin3@example.com',
            'password' => Hash::make('admin123'),
            'prenom' => 'boubakar',
            'adresse' => 'niger',
            'numero' => '25697524',
            'date_naissance' => '15/12/2000',
            'genre' => 'H',
            'role'=>'admin',
            'profession' => 'developpeur',
        ]);
        
        
    }
}