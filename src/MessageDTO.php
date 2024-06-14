<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class MessageDTO implements JsonSerializable
{
    public function __construct(
        public readonly int      $id,
        public readonly int      $userId,
        public readonly int      $chatId,
        public readonly string   $body,
        public readonly DateTime $createdAt,
    )
    {
    }

    #[ArrayShape(['id' => "int", 'userId' => "int", 'chatId' => "int", 'body' => "string", 'createdAt' => "string"])]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    #[ArrayShape(['id' => "int", 'userId' => "int", 'chatId' => "int", 'body' => "string", 'createdAt' => "string"])]
    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'userId'    => $this->userId,
            'chatId'    => $this->chatId,
            'body'      => $this->body,
            'createdAt' => $this->createdAt,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['userId'], $data['chatId'], $data['body'], $data['createdAt']);
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        return new self($data['id'], $data['userId'], $data['chatId'], $data['body'], DateTime::createFromFormat('Y-m-d H:i:s.u', $data['createdAt']['date'], new \DateTimeZone($data['createdAt']['timezone'])));
    }
}