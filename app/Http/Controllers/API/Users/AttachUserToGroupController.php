<?php

namespace App\Http\Controllers\API\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Support\Facades\Validator;

class AttachUserToGroupController extends APIController
{
    public function __construct(
        private UserService $userService,
        private GroupService $groupService,
    ) {}

    public function __invoke(string $id, Request $request)
    {
        $user = $this->userService->findById($id);
        if (! $user instanceof User) {
            return $this->error(Response::HTTP_NOT_FOUND, 'User not found!');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'group_id' => ['required', 'integer'],
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid user information!', $validator->errors()->toArray());
        }

        $group = $this->groupService->findById($request->input('group_id'));
        if (! $group instanceof Group) {
            return $this->error(Response::HTTP_NOT_FOUND, 'Group not found!');
        }

        if (! $this->userService->update($user, $validator->validated())) {
            return $this->error(Response::HTTP_CONFLICT, 'Impossible to update user!');
        }

        return $this->success();
    }
}