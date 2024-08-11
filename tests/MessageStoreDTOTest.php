<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\AbstractDTO;
use Motyriev\MyDTOLibrary\MessageStoreDTO;
use PHPUnit\Framework\TestCase;

class MessageStoreDTOTest extends TestCase
{
    public function testDTOCreation(): void
    {
        $traceId = 'abc123';
        $userId = 1;
        $chatId = 2;
        $body = 'Test message';

        $dto = new MessageStoreDTO($traceId, $userId, $chatId, $body);

        $this->assertInstanceOf(AbstractDTO::class, $dto);
        $this->assertEquals($traceId, $dto->traceId);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($body, $dto->body);
    }

    public function testToArray(): void
    {
        $traceId = 'abc123';
        $userId = 1;
        $chatId = 2;
        $body = 'Test message';

        $dto = new MessageStoreDTO($traceId, $userId, $chatId, $body);
        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($traceId, $dtoArr['traceId']);
        $this->assertEquals($userId, $dtoArr['userId']);
        $this->assertEquals($chatId, $dtoArr['chatId']);
        $this->assertEquals($body, $dtoArr['body']);
    }

    public function testFromArray(): void
    {
        $data = [
            'traceId' => 'abc123',
            'userId'  => 1,
            'chatId'  => 2,
            'body'    => 'Test message',
        ];

        $dto = MessageStoreDTO::fromArray($data);

        $this->assertInstanceOf(MessageStoreDTO::class, $dto);
        $this->assertEquals($data['traceId'], $dto->traceId);
        $this->assertEquals($data['userId'], $dto->userId);
        $this->assertEquals($data['chatId'], $dto->chatId);
        $this->assertEquals($data['body'], $dto->body);
    }

    public function testValidationRules(): void
    {
        $rules = MessageStoreDTO::rules();

        $expectedRules = [
            'traceId' => ['required', 'string'],
            'userId'  => ['required', 'numeric'],
            'chatId'  => ['required', 'numeric'],
            'body'    => ['required', 'string'],
        ];

        $this->assertEquals($expectedRules, $rules);
    }
}
