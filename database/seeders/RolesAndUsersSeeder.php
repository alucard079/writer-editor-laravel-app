<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $writer = Role::firstOrCreate(['name' => 'writer']);
        $editor = Role::firstOrCreate(['name' => 'editor']);

        $writerUser = User::create([
            'firstname' => 'John',
            'lastname'  => 'Doe',
            'email'     => 'johndoe@example.com',
            'password'  => bcrypt('password'),
            'status'    => 'Active'
        ]);

        $editorUser = User::create([
            'firstname' => 'Jane',
            'lastname'  => 'Doe',
            'email'     => 'janedoe@example.com',
            'password'  => bcrypt('password'),
            'status'    => 'Active'
        ]);

        $writerUser->assignRole($writer);
        $editorUser->assignRole($editor);
    }
}
