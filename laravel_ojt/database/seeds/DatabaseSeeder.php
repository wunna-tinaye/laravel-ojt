<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        {
    User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('12345678'),
        'type' => 1,
        'profile' => 'uploads/ZfSpSBuNGmBmKe7Crpx3hzLBMZrRZ8fu27ar9HaQ.jpeg',
        'phone' => '09987654321',
        'address' => 'Yangon',
        'dob' => '1996-08-23',
        'create_user_id' => 1,
        'updated_user_id' => 1,
    ]);
}

    }
}
