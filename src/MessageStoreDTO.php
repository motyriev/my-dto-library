<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class MessageStoreDTO implements JsonSerializable
{
    public function __construct(
        public readonly int    $userId,
        public readonly int    $chatId,
        public readonly string $body,
    )
    {
    }

    #[ArrayShape(['userId' => "int", 'chatId' => "int", 'body' => "string"])]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    #[ArrayShape(['userId' => "int", 'chatId' => "int", 'body' => "string"])]
    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'chatId' => $this->chatId,
            'body'   => $this->body,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromArray(array $data): self
    {
        return new self($data['userId'], $data['chatId'], $data['body']);
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        return new self($data['userId'], $data['chatId'], $data['body']);
    }
}