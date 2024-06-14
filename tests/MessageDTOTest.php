<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\MessageDTO;
use PHPUnit\Framework\TestCase;
use \DateTime;

class MessageDTOTest extends TestCase
{
    public function testDTOCreation()
    {
        $id = 1;
        $userId = 1;
        $chatId = 1;
        $body = 'Hello DTO';
        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-13 01:34:56');
        $dto = new MessageDTO($id, $userId, $chatId, $body, $createdAt);

        $this->assertEquals($id, $dto->id);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($body, $dto->body);
        $this->assertEquals($createdAt, $dto->createdAt);
    }

    public function testToArray()
    {
        $id = 1;
        $userId = 1;
        $chatId = 1;
        $body = 'Hello array';
        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-13 01:34:56');
        $dto = new MessageDTO($id, $userId, $chatId, $body, $createdAt);

        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($id, $dtoArr['id']);
        $this->assertEquals($userId, $dtoArr['userId']);
        $this->assertEquals($chatId, $dtoArr['chatId']);
        $this->assertEquals($body, $dtoArr['body']);
        $this->assertEquals($createdAt, $dtoArr['createdAt']);
    }

    public function testToJson()
    {
        $id = 1;
        $userId = 1;
        $chatId = 1;
        $body = 'Hello json';
        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-13 01:34:56');

        $dto = new MessageDTO($id, $userId, $chatId, $body, $createdAt);
        $expectedJson = '{"id":1,"userId":1,"chatId":1,"body":"Hello json","createdAt":{"date":"2023-03-13 01:34:56.000000","timezone_type":3,"timezone":"UTC"}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $dto->toJson());
    }

    public function testFromArray()
    {
        $arr = [
            'id'        => 1,
            'userId'    => 1,
            'chatId'    => 1,
            'body'      => 'Hello DTO',
            'createdAt' => DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-13 01:34:56'),
        ];

        $dto = MessageDTO::fromArray($arr);

        $this->assertIsObject($dto);
        $this->assertEquals($arr['id'], $dto->id);
        $this->assertEquals($arr['userId'], $dto->userId);
        $this->assertEquals($arr['chatId'], $dto->chatId);
        $this->assertEquals($arr['body'], $dto->body);
        $this->assertEquals($arr['createdAt'], $dto->createdAt);
    }

    public function testFromJson()
    {
        $id = 1;
        $userId = 1;
        $chatId = 1;
        $body = 'Hello DTO';
        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-13 01:34:56');

        $json = '{"id":1,"userId":1,"chatId":1,"body":"Hello DTO","createdAt":{"date":"2023-03-13 01:34:56.000000","timezone_type":3,"timezone":"UTC"}}';

        $dto = MessageDTO::fromJson($json);
        $this->assertIsObject($dto);
        $this->assertEquals($id, $dto->id);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($body, $dto->body);
        $this->assertEquals($createdAt, $dto->createdAt);
    }
}