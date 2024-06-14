<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\MessageStoreDTO;
use PHPUnit\Framework\TestCase;

class MessageStoreDTOTest extends TestCase
{
    public function testDTOCreation()
    {
        $userId = 1;
        $chatId = 2;
        $body = 'Hello DTO';
        $dto = new MessageStoreDTO($userId, $chatId, $body);

        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($body, $dto->body);
    }

    public function testToArray()
    {
        $userId = 1;
        $chatId = 2;
        $body = 'Hello array';
        $dto = new MessageStoreDTO($userId, $chatId, $body);

        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($userId, $dtoArr['userId']);
        $this->assertEquals($chatId, $dtoArr['chatId']);
        $this->assertEquals($body, $dtoArr['body']);
    }

    public function testToJson()
    {
        $userId = 1;
        $chatId = 2;
        $body = 'Hello json';

        $dto = new MessageStoreDTO($userId, $chatId, $body);
        $expectedJson = '{"userId":1,"chatId":2,"body":"Hello json"}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $dto->toJson());
    }

    /**
     * @throws \ReflectionException
     */
    public function testFromArray()
    {
        $arr = [
            'userId'    => 1,
            'chatId'    => 2,
            'body'      => 'Hello DTO',
        ];

        $dto = MessageStoreDTO::fromArray($arr);

        $this->assertIsObject($dto);
        $this->assertEquals($arr['userId'], $dto->userId);
        $this->assertEquals($arr['chatId'], $dto->chatId);
        $this->assertEquals($arr['body'], $dto->body);
    }

    /**
     * @throws \ReflectionException
     */
    public function testFromJson()
    {
        $userId = 1;
        $chatId = 2;
        $body = 'Hello DTO';

        $json = '{"userId":1,"chatId":2,"body":"Hello DTO"}';

        $dto = MessageStoreDTO::fromJson($json);
        $this->assertIsObject($dto);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($body, $dto->body);
    }

}