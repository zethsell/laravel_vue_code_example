<?php

namespace Tests\Unit\Infra\Repositoties\Booking\User;

use App\Models\User;
use App\Repositories\UserRepository;
use ReflectionClass;

describe('UserRepository', function () {
    $sut = new UserRepository();
    $data = [
        'id' => 1,
        'name' => 1,
        'email' => 1,
        'password' => 'any_hashed_password',
    ];

    beforeEach(function () {
        User::truncate();
        User::factory()->count(9)->create();
    });

    test(
        'should return User Instance when getModel is called', function () {
        $repository = new UserRepository();
        $reflectionClass = new ReflectionClass(UserRepository::class);
        $method = $reflectionClass->getMethod('getModel');
        $method->setAccessible(true);
        $result = $method->invoke($repository);
        expect($result)->toBeInstanceOf(User::class);
    });


    test('should return a list of User', function () use ($sut) {
        $list = $sut->list();
        expect($list)->toHaveLength(9);
    });

    test('should return empty if table is empty', function () use ($sut) {
        User::truncate();
        $list = $sut->list();
        expect($list)->toHaveLength(0);
    });

    test('should return a User if conditions matches', function () use ($sut) {
        $user = $sut->showByConditions(['id' => 1]);
        expect($user->id)->toBe(1);
    });

    test('should return null if User is not found', function () use ($sut) {
        $user = $sut->showByConditions(['id' => 10]);
        expect($user)->toBe(null);
    });

    test('should create an User if id is not defined', function () use ($sut, &$data) {
        $sut->deleteByConditions(['id' => 1]);
        $tempData = new User($data);
        unset ($tempData['id']);
        $sut->save($tempData);
        $list = $sut->list();
        expect($list)->toHaveLength(9);
    });

    test('should create an User if id is defined and is not found in the table', function () use ($sut, &$data) {
        $sut->deleteByConditions(['id' => 1]);
        $tempData = new User($data);
        $tempData['id'] = 10;
        $sut->save($tempData);
        $list = $sut->list();
        expect($list)->toHaveLength(9);
    });

    test('should update an User if id is defined and is found in the table', function () use ($sut, &$data) {
        $sut->storeOrUpdate(
            ['id' => 1],
            $data
        );
        $list = $sut->list();
        expect($list)->toHaveLength(9);
    });

    test('should delete an User if id exists', function () use ($sut) {
        $sut->deleteByConditions(['id' => 1]);
        $list = $sut->list();
        expect($list)->toHaveLength(8);
    });

    test('should not delete an User if id not exists', function () use ($sut) {
        $sut->deleteByConditions(['id' => 10]);
        $list = $sut->list();
        expect($list)->toHaveLength(9);
    });
});
