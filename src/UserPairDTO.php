<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

class UserPairDTO extends AbstractDTO
{
    public function __construct(
        public readonly int $userId1,
        public readonly int $userId2
    )
    {
    }
}