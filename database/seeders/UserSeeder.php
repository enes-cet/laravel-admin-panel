<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate([
            "name"=> "yonetici",
        ],
        [
            "name"=> "yonetici",
            "title"=>"yonetici",
            "description"=> "Sitenin genel yönetimini sağlar.",
        ]
        );

        $roleBlog = Role::updateOrCreate([
            "name"=> "blog-yoneticisi",
        ],
        [
            "name"=> "blog-yonetici",
            "title"=>"Blog yönetici",
            "description"=> "Blog yönetimini sağlar.",
        ]
        );

        $roleEcommerce = Role::updateOrCreate([
            "name"=> "e-ticaret-yoneticisi",
        ],
        [
            "name"=> "e-ticaret-yonetici",
            "title"=>"E-ticaret yönetici",
            "description"=> "E-ticaret yönetimini sağlar.",
        ]
        );
        
        $user = User::updateOrCreate(
            [
                'email'=> 'enescetinkaya162@gmail.com',
            ],
            [
            'name' => 'Enes Çet',
            'email'=> 'enescetinkaya162@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);
        
        $user->assignRole($role);

         $users = User::factory(50)->create();
         foreach ($users as $user) {
            $user->assignRole(rand(0,1)==1?$roleBlog: $roleEcommerce);
         }
    }
}
