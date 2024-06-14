<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

interface Validable
{
    public static function rules(): array;
}