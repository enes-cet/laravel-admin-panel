<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

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

        $permissions['blog-yoneticisi']=[
            [
                "title"=>"Yazıları Görüntüleyebilir",
                "description"=> "Tüm yazıları görüntüleyebilir.",
            ],
            [
                "title"=>"Yazıları Düzenleyebilir",
                "description"=> "Tüm yazıları düzenleyebilir.",
            ],
            [
                "title"=>"Yazı Kategorilerini Görüntüleyebilir",
                "description"=> "Tüm yazı kategorilerini görüntüleyebilir.",
            ],
            [
                "title"=>"Yazı Kategorilerini Düzenleyebilir",
                "description"=> "Tüm yazı kategorilerini düzenleyebilir.",
            ],
        ];

        $permissions['e-ticaret-yoneticisi']=[
            [
                "title"=>"Siparişleri Görüntüleyebilir",
                "description"=> "Tüm siparişleri görüntüleyebilir.",
            ],
            [
                "title"=>"Siparişleri Düzenleyebilir",
                "description"=> "Tüm siparişleri düzenleyebilir.",
            ],
            [
                "title"=>"Ürünleri Görüntüleyebilir",
                "description"=> "Tüm ürünleri görüntüleyebilir.",
            ],
            [
                "title"=>"Ürünleri Düzenleyebilir",
                "description"=> "Tüm ürünleri düzenleyebilir.",
            ],
        ];
        foreach ($permissions as $key => $permission) {
            $role = Role::where('name',$key)->first();
            foreach ($permission as $p) {
                $newPermission = Permission::updateOrCreate(
                    ['name' =>Str::slug($p['title'])],
                    [
                        'name' =>Str::slug($p['title']),
                        'title' =>$p['title'],
                        'description' => $p['description'],
                            ]
                    );
                    $role->givePermissionTo($newPermission);
            }
        };
        
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
