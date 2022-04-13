<?php

namespace App\Http\Controllers\API\Groups;

use App\Http\Controllers\APIController;
use App\Services\GroupService;
use Illuminate\Http\Request;

class ListGroupsController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke(Request $request)
    {
        $groups = $this->groupService->paginate((int)$request->query('page', 1));

        return $this->success($groups);
    }
}