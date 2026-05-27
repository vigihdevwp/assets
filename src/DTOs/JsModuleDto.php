<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\{JsModuleInterface, JsOptionsInterface};

final class JsModuleDto implements JsModuleInterface
{

    /**
     * @param JsOptionsDto $jsOption
     */
    public function __construct(
        private readonly string $basepath,
        private readonly string $baseUrl,
        private readonly string $version,
        private readonly JsOptionsInterface $jsOption,
        private readonly array $depends = [],
        private readonly array $js = [],
    ) {}

    public function getBasepath(): string
    {
        return $this->basepath;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getJs(): array
    {
        return $this->js;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getJsOptions(): JsOptionsInterface
    {
        return $this->jsOption;
    }

    public function getDepends(): array
    {
        return $this->depends;
    }
}
