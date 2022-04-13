<?php

namespace App\Http\Controllers\API\Groups;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\GroupService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Validator;

class CreateGroupController extends APIController
{
    public function __construct(
        private GroupService $groupService
    ) {}

    public function __invoke(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                Group::NAME_COLUMN          => ['required', 'string', 'min:1'],
                Group::DESCRIPTION_COLUMN   => ['nullable', 'string']
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid group information!', $validator->errors()->toArray());
        }

        $group = $this->groupService->findByName($request->input(Group::NAME_COLUMN));
        if ($group instanceof Group) {
            return $this->error(Response::HTTP_CONFLICT, 'Group name already exists!');
        }

        $group = $this->groupService->create($validator->validated());

        return $this->success($group, Response::HTTP_CREATED);
    }
}