<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('users-create');
    }

    public function store(StoreUserRequest $request, UserService $userService)
    {
        $user = $userService->create($request->validated());

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function showConvertedCurrency(User $user, $currency)
    {
        $user->convertCurrency($currency);

        return new UserResource($user);
    }


    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
