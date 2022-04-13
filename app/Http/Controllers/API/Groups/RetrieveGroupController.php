<?php

namespace App\Http\Controllers\API\Groups;

use App\Http\Controllers\APIController;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Response;

class RetrieveGroupController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke(int $id)
    {
        $group = $this->groupService->findById($id);
        if (! $group instanceof Group) {
            return $this->error(Response::HTTP_NOT_FOUND, 'Group not found!');
        }

        return $this->success($group);
    }
}