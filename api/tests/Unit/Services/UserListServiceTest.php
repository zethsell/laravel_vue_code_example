<?php

namespace Tests\Unit\Services;

use App\Repositories\UserRepository;
use App\Services\User\UserListService;
use Error;
use Mockery;


describe('UserListService', function () {
    test('should call repository.list once', function () {
        $repository = Mockery::mock(UserRepository::class);
        $repository->shouldReceive('list')->once();
        $sut = new UserListService($repository);
        $sut->execute();
    });

    test('should return a list of property areas', function () {
        $repository = Mockery::mock(UserRepository::class);
        $repository->shouldReceive('list')->once()->andReturn([1, 2, 3]);
        $sut = new UserListService($repository);
        $result = $sut->execute();
        expect($result)->toBe([1, 2, 3]);
    });

    test('should return empty if the list method return empty', function () {
        $repository = Mockery::mock(UserRepository::class);
        $repository->shouldReceive('list')->once()->andReturn([]);
        $sut = new UserListService($repository);
        $result = $sut->execute();
        expect($result)->toBe([]);
    });

    test('should rethrow if load throws', function () {
        $repository = Mockery::mock(UserRepository::class);
        $repository->shouldReceive('list')->once()->andThrow(new Error('Failed!'));
        $sut = new UserListService($repository);
        expect(function () use ($sut) {
            $sut->execute();
        })->toThrow(Error::class, 'Failed!');
    });
});
