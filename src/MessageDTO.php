<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

use DateTime;

class MessageDTO extends AbstractDTO
{
    public function __construct(
        public readonly string   $traceId,
        public readonly int      $id,
        public readonly int      $userId,
        public readonly int      $chatId,
        public readonly string   $userEmail,
        public readonly string   $body,
        public readonly DateTime $createdAt,
    )
    {
    }
}