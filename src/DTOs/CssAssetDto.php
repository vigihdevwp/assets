<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\{CssAssetInterface};

final class CssAssetDto implements CssAssetInterface
{

    public function __construct(
        private readonly string $basepath,
        private readonly string $baseUrl,
        private readonly string $version,
        private readonly array $css,
        private readonly array $depends = [],
    ) {}

    public function getBasepath(): string
    {
        return $this->basepath;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getDepends(): array
    {
        return $this->depends;
    }

    public function getCss(): array
    {
        return $this->css;
    }
}
