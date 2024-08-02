<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

class AddFriendRequestDTO extends AbstractDTO implements Validable
{
    public function __construct(
        public readonly string $traceId,
        public readonly int    $requesterId,
        public readonly int    $requestedId,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'traceId'     => ['required', 'string'],
            'requesterId' => ['required', 'numeric'],
            'requestedId' => ['required', 'numeric'],
        ];
    }
}