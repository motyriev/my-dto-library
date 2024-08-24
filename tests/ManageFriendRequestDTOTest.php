<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\ManageFriendRequestDTO;
use PHPUnit\Framework\TestCase;

class ManageFriendRequestDTOTest extends TestCase
{
    public function testDTOCreationWithAcceptedStatus(): void
    {
        $traceId = 'abc123';
        $requestId = 1;
        $status = 'accepted';

        $dto = new ManageFriendRequestDTO($traceId, $requestId, $status);

        $this->assertEquals($traceId, $dto->traceId);
        $this->assertEquals($requestId, $dto->requestId);
        $this->assertEquals($status, $dto->status);
    }

    public function testDTOCreationWithDeclinedStatus(): void
    {
        $traceId = 'abc123';
        $requestId = 1;
        $status = 'declined';

        $dto = new ManageFriendRequestDTO($traceId, $requestId, $status);

        $this->assertEquals($traceId, $dto->traceId);
        $this->assertEquals($requestId, $dto->requestId);
        $this->assertEquals($status, $dto->status);
    }

    public function testToArray(): void
    {
        $traceId = 'abc123';
        $requestId = 1;
        $status = 'accepted';

        $dto = new ManageFriendRequestDTO($traceId, $requestId, $status);
        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($traceId, $dtoArr['traceId']);
        $this->assertEquals($requestId, $dtoArr['requestId']);
        $this->assertEquals($status, $dtoArr['status']);
    }

    public function testFromArray(): void
    {
        $data = [
            'traceId'   => 'abc123',
            'requestId' => 1,
            'status'    => 'accepted',
        ];

        $dto = ManageFriendRequestDTO::fromArray($data);

        $this->assertInstanceOf(ManageFriendRequestDTO::class, $dto);
        $this->assertEquals($data['traceId'], $dto->traceId);
        $this->assertEquals($data['requestId'], $dto->requestId);
        $this->assertEquals($data['status'], $dto->status);
    }

    public function testValidationRules(): void
    {
        $rules = ManageFriendRequestDTO::rules();

        $expectedRules = [
            'traceId'   => ['required', 'string'],
            'requestId' => ['required', 'numeric'],
            'status'    => ['required', 'string', 'in:accepted,declined'],
        ];

        $this->assertEquals($expectedRules, $rules);
    }
}

