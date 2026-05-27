<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Exceptions;

use Exception;

final class WpAssetsException extends Exception
{

    public static function directoryNotFound(string $directory): self
    {
        return new self("Directory not found: $directory");
    }

    public static function fileNotFound(string $file): self
    {
        return new self("File not found: $file");
    }
}
