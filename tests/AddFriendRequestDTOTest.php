<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\AddFriendRequestDTO;
use PHPUnit\Framework\TestCase;

class AddFriendRequestDTOTest extends TestCase
{
    public function testDTOCreation(): void
    {
        $traceId = 'abc123';
        $requesterId = 1;
        $requestedId = 2;

        $dto = new AddFriendRequestDTO($traceId, $requesterId, $requestedId);

        $this->assertEquals($traceId, $dto->traceId);
        $this->assertEquals($requesterId, $dto->requesterId);
        $this->assertEquals($requestedId, $dto->requestedId);
    }

    public function testToArray(): void
    {
        $traceId = 'abc123';
        $requesterId = 1;
        $requestedId = 2;

        $dto = new AddFriendRequestDTO($traceId, $requesterId, $requestedId);
        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($traceId, $dtoArr['traceId']);
        $this->assertEquals($requesterId, $dtoArr['requesterId']);
        $this->assertEquals($requestedId, $dtoArr['requestedId']);
    }

    public function testFromArray(): void
    {
        $data = [
            'traceId'     => 'abc123',
            'requesterId' => 1,
            'requestedId' => 2,
        ];

        $dto = AddFriendRequestDTO::fromArray($data);

        $this->assertInstanceOf(AddFriendRequestDTO::class, $dto);
        $this->assertEquals($data['traceId'], $dto->traceId);
        $this->assertEquals($data['requesterId'], $dto->requesterId);
        $this->assertEquals($data['requestedId'], $dto->requestedId);
    }

    public function testValidationRules(): void
    {
        $rules = AddFriendRequestDTO::rules();

        $expectedRules = [
            'traceId'     => ['required', 'string'],
            'requesterId' => ['required', 'numeric'],
            'requestedId' => ['required', 'numeric'],
        ];

        $this->assertEquals($expectedRules, $rules);
    }
}

