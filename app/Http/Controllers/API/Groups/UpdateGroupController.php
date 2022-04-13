<?php

namespace App\Http\Controllers\API\Groups;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\GroupService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Validator;

class UpdateGroupController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke(string $id, Request $request)
    {
        $group = $this->groupService->findById($id);
        if (! $group instanceof Group) {
            return $this->error(Response::HTTP_NOT_FOUND, 'Group not found!');
        }

        $validator = Validator::make(
            $request->all(),
            [
                Group::NAME_COLUMN          => ['nullable', 'string', 'min:1'],
                Group::DESCRIPTION_COLUMN   => ['nullable', 'string']
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid group information!', $validator->errors()->toArray());
        }

        if ($request->has(Group::NAME_COLUMN)) {
            $existGroup = $this->groupService->existsByName($group, $request->input(Group::NAME_COLUMN));
            if ($existGroup instanceof Group) {
                return $this->error(Response::HTTP_CONFLICT, 'Group name already exists!');
            }
        }

        if (! $this->groupService->update($group, $validator->validated())) {
            return $this->error(Response::HTTP_CONFLICT, 'Impossible to update group!');
        }

        return $this->success();
    }
}