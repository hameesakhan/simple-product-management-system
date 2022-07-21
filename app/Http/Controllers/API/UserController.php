<?php

namespace App\Http\Controllers\API;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->validated());
        $user->password = bcrypt($request->password);
        $user->save();

        $user->syncRoles([$request->role]);

        $user->load('roles');
        return ['user' => $user];
    }

    public function update(User $user, UserRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if (strlen($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $user->syncRoles([$request->role]);

        $user->load('roles');
        return ['user' => $user];
    }

    public function destroy(User $user)
    {
        return ['success' => $user->delete()];
    }
}
