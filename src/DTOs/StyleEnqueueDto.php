<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\StyleEnqueueInterface;

final class StyleEnqueueDto implements StyleEnqueueInterface
{

    public function __construct(
        private readonly string $handle,
        private readonly string $srcUri,
        private readonly string|bool|null $version = '1.0',
        private readonly array $depends = [],
        private readonly string $media = 'all'
    ) {}

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function getSrcUri(): string
    {
        return $this->srcUri;
    }

    public function getDepends(): array
    {
        return $this->depends;
    }

    public function getVersion(): string|bool|null
    {
        return $this->version;
    }

    public function getMedia(): string
    {
        return $this->media;
    }
}
