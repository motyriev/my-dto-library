<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\AbstractDTO;
use Motyriev\MyDTOLibrary\MessageDTO;
use PHPUnit\Framework\TestCase;
use DateTime;

class MessageDTOTest extends TestCase
{
    public function testDTOCreation(): void
    {
        $id = 1;
        $userId = 2;
        $chatId = 3;
        $userEmail = 'user@example.com';
        $body = 'Hello, world!';
        $createdAt = new DateTime('2023-03-13 01:34:56');

        $dto = new MessageDTO($id, $userId, $chatId, $userEmail, $body, $createdAt);

        $this->assertInstanceOf(AbstractDTO::class, $dto);
        $this->assertEquals($id, $dto->id);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($userEmail, $dto->userEmail);
        $this->assertEquals($body, $dto->body);
        $this->assertEquals($createdAt, $dto->createdAt);
    }

    public function testToArray(): void
    {
        $id = 1;
        $userId = 2;
        $chatId = 3;
        $userEmail = 'user@example.com';
        $body = 'Hello, world!';
        $createdAt = new \DateTime('2023-03-13 01:34:56', new \DateTimeZone('UTC'));

        $dto = new MessageDTO($id, $userId, $chatId, $userEmail, $body, $createdAt);
        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($id, $dtoArr['id']);
        $this->assertEquals($userId, $dtoArr['userId']);
        $this->assertEquals($chatId, $dtoArr['chatId']);
        $this->assertEquals($userEmail, $dtoArr['userEmail']);
        $this->assertEquals($body, $dtoArr['body']);
        // Изменение формата даты на ISO 8601 с UTC для соответствия фактическому значению
        $this->assertEquals($createdAt->format('Y-m-d\TH:i:s\Z'), $dtoArr['createdAt']);
    }

    public function testToJson(): void
    {
        $id = 1;
        $userId = 2;
        $chatId = 3;
        $userEmail = 'user@example.com';
        $body = 'Hello, world!';
        $createdAt = new DateTime('2023-03-13 01:34:56', new \DateTimeZone('UTC'));

        $dto = new MessageDTO($id, $userId, $chatId, $userEmail, $body, $createdAt);
        $expectedJson = json_encode([
            'id' => $id,
            'userId' => $userId,
            'chatId' => $chatId,
            'userEmail' => $userEmail,
            'body' => $body,
            'createdAt' => $createdAt->format('Y-m-d\TH:i:s\Z'),
        ]);

        $this->assertJsonStringEqualsJsonString($expectedJson, $dto->toJson());
    }


    public function testFromArray(): void
    {
        $data = [
            'id'        => 1,
            'userId'    => 2,
            'chatId'    => 3,
            'userEmail' => 'user@example.com',
            'body'      => 'Hello, world!',
            'createdAt' => new DateTime('2023-03-13 01:34:56'),
        ];

        $dto = MessageDTO::fromArray($data);

        $this->assertInstanceOf(MessageDTO::class, $dto);
        $this->assertEquals($data['id'], $dto->id);
        $this->assertEquals($data['userId'], $dto->userId);
        $this->assertEquals($data['chatId'], $dto->chatId);
        $this->assertEquals($data['userEmail'], $dto->userEmail);
        $this->assertEquals($data['body'], $dto->body);
        $this->assertEquals($data['createdAt'], $dto->createdAt);
    }

    public function testFromJson(): void
    {
        $id = 1;
        $userId = 2;
        $chatId = 3;
        $userEmail = 'user@example.com';
        $body = 'Hello, world!';
        $createdAt = new DateTime('2023-03-13 01:34:56');

        $json = json_encode([
            'id'        => $id,
            'userId'    => $userId,
            'chatId'    => $chatId,
            'userEmail' => $userEmail,
            'body'      => $body,
            'createdAt' => $createdAt->format(DateTime::ISO8601),
        ]);

        $dto = MessageDTO::fromJson($json);

        $this->assertInstanceOf(MessageDTO::class, $dto);
        $this->assertEquals($id, $dto->id);
        $this->assertEquals($userId, $dto->userId);
        $this->assertEquals($chatId, $dto->chatId);
        $this->assertEquals($userEmail, $dto->userEmail);
        $this->assertEquals($body, $dto->body);
        $this->assertInstanceOf(DateTime::class, $dto->createdAt);
        $this->assertEquals($createdAt->format('Y-m-d H:i:s'), $dto->createdAt->format('Y-m-d H:i:s'));
    }
}

