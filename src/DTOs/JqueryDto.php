<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\{JqueryInterface, JsOptionsInterface};
use VigihdevWP\Assets\DTOs\JsOptionsDto;

final class JqueryDto implements JqueryInterface
{

    public function __construct(
        private readonly string $srcUri,
        private readonly string $handle = 'jquery',
        private readonly string|bool|null $version = '1.0',
        private readonly array $options = []
    ) {}

    public function getJsOption(): JsOptionsInterface
    {
        return new JsOptionsDto(
            inFooter: true
        );
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function getSrcUri(): string
    {
        return $this->srcUri;
    }

    public function getVersion(): string|bool|null
    {
        return $this->version;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
