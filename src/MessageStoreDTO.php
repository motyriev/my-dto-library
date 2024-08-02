<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

class MessageStoreDTO extends AbstractDTO implements Validable
{
    public function __construct(
        public readonly string $traceId,
        public readonly int    $userId,
        public readonly int    $chatId,
        public readonly string $body,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'traceId' => ['required', 'string'],
            'userId'  => ['required', 'numeric'],
            'chatId'  => ['required', 'numeric'],
            'body'    => ['required', 'string'],
        ];
    }
}