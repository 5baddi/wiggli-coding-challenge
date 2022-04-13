<?php

namespace App\Http\Controllers\API\Groups;

use App\Http\Controllers\APIController;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Response;

class DeleteGroupController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke(string $id)
    {
        $group = $this->groupService->findById($id);
        if (! $group instanceof Group) {
            return $this->error(Response::HTTP_NOT_FOUND, 'Group not found!');
        }

        if (! $this->groupService->delete($group)) {
            return $this->error(Response::HTTP_CONFLICT, 'Impossible to delete group!');
        }

        return $this->success(null, Response::HTTP_NO_CONTENT);
    }
}