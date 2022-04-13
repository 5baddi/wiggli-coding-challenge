<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    public function __construct(private UserService $userService) {}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userService->create([
            User::FIRST_NAME_COLUMN => 'Mohamed',
            User::LAST_LOGIN_COLUMN => 'Baddi',
            User::EMAIL_COLUMN      => 'project@baddi.info',
            User::PASSWORD_COLUMN   => 'password',
        ]);
    }
}
