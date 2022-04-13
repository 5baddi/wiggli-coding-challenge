<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use App\Services\GroupService;
use App\Services\UserService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function __construct(
        private UserService $userService,
        private GroupService $groupService
    ) {}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userService->create([
            User::FIRST_NAME_COLUMN => 'Mohamed',
            User::LAST_NAME_COLUMN  => 'Baddi',
            User::EMAIL_COLUMN      => 'project@baddi.info',
            User::PASSWORD_COLUMN   => 'password',
        ]);
        
        $this->groupService->create([
            Group::NAME_COLUMN => 'Wiggli',
        ]);
    }
}
