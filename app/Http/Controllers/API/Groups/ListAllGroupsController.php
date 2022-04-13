<?php

namespace App\Http\Controllers\API\Groups;

use App\Http\Controllers\APIController;
use App\Services\GroupService;

class ListAllGroupsController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke()
    {
        $groups = $this->groupService->all();

        return $this->success($groups);
    }
}