<?php

declare(strict_types=1);

namespace Services;

use Exception;
use Models\Entities\DrinkCategory;
use Models\Entities\State;
use Models\Entities\User;
use Models\Entities\UserFavouriteCategory;
use Models\Requests\LoginRequest;
use Models\Requests\RegisterRequest;
use Repositories\Repository;

readonly class AuthService
{
    /**
     * @param Repository<User> $userRepository
     * @param Repository<State> $stateRepository
     * @param Repository<DrinkCategory> $categoryRepository
     * @param Repository<UserFavouriteCategory> $favouriteRepository
     */
    public function __construct(private Repository $userRepository,
                                private Repository $stateRepository,
                                private Repository $categoryRepository,
                                private Repository $favouriteRepository,
    )
    {
    }

    public function register(RegisterRequest $request): User
    {
        $user = new User();
        $user->username = $request->username;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_ARGON2I);
        $user->stateId = $this->stateRepository->findById($request->state)?->id;

        $user->id = $this->userRepository->insert([$user]);
        $interests = array_map(function ($category) use ($user) {
            $category = $this->categoryRepository->findById($category)?->id;
            $interest = new UserFavouriteCategory();
            $interest->userId = $user->id;
            $interest->categoryId = $category;
            return $interest;
        }, $request->interests);

        $this->favouriteRepository->insert($interests);

        return $user;
    }

    public function login(LoginRequest $request): User
    {
        $user = $this->userRepository->findBy(['email' => $request->email]);
        if (is_null($user) || !password_verify($request->password, $user->password)) {
            throw new Exception("User not found");
        }
        return $user;
    }
}