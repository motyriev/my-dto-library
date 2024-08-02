<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

class ManageFriendRequestDTO extends AbstractDTO implements Validable
{
    public function __construct(
        public readonly string $traceId,
        public readonly int    $requestId,
        public readonly string $status,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'traceId'   => ['required', 'string'],
            'requestId' => ['required', 'numeric'],
            'status'    => ['required', 'string'],
        ];
    }
}