<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary\Tests;

use Motyriev\MyDTOLibrary\AbstractDTO;
use Motyriev\MyDTOLibrary\UserPairDTO;
use PHPUnit\Framework\TestCase;

class UserPairDTOTest extends TestCase
{
    public function testDTOCreation()
    {
        $userId1 = 1;
        $userId2 = 2;
        $dto = new UserPairDTO($userId1, $userId2);

        $this->assertInstanceOf(AbstractDTO::class, $dto);
        $this->assertEquals($userId1, $dto->userId1);
        $this->assertEquals($userId2, $dto->userId2);
    }

    public function testToArray()
    {
        $userId1 = 1;
        $userId2 = 2;
        $dto = new UserPairDTO($userId1, $userId2);

        $dtoArr = $dto->toArray();

        $this->assertIsArray($dtoArr);
        $this->assertEquals($userId1, $dtoArr['userId1']);
        $this->assertEquals($userId2, $dtoArr['userId2']);
    }

    public function testToJson()
    {
        $userId1 = 1;
        $userId2 = 2;
        $dto = new UserPairDTO($userId1, $userId2);
        $expectedJson = '{"userId1":1,"userId2":2}';

        $this->assertJsonStringEqualsJsonString($expectedJson, $dto->toJson());
    }

    /**
     * @throws \ReflectionException
     */
    public function testFromArray()
    {
        $arr = [
            'userId1' => 1,
            'userId2' => 2,
        ];

        $dto = UserPairDTO::fromArray($arr);

        $this->assertIsObject($dto);
        $this->assertEquals($arr['userId1'], $dto->userId1);
        $this->assertEquals($arr['userId2'], $dto->userId2);
    }

    /**
     * @throws \ReflectionException
     */
    public function testFromJson()
    {
        $json = '{"userId1":1,"userId2":2}';

        $dto = UserPairDTO::fromJson($json);
        $this->assertInstanceOf(AbstractDTO::class, $dto);
        $this->assertEquals(1, $dto->userId1);
        $this->assertEquals(2, $dto->userId2);
    }
}
