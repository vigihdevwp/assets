<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\{JsAssetInterface, JsOptionsInterface};

final class JsAssetDto implements JsAssetInterface
{

    public function __construct(
        private readonly string $basepath,
        private readonly string $baseUrl,
        private readonly string|int $version,
        private readonly array $depends = [],
        private readonly array $js = []
    ) {}

    public function getJsOptions(): JsOptionsInterface
    {
        return new JsOptionsDto(
            inFooter: true
        );
    }

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
        return (string) $this->version;
    }

    public function getDepends(): array
    {
        return $this->depends;
    }

    public function getJs(): array
    {
        return $this->js;
    }
}
