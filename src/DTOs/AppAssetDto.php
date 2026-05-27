<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\DTOs;

use VigihdevWP\Assets\Contracts\AppAssetInterface;
use VigihdevWP\Assets\Contracts\JsOptionsInterface;

final class AppAssetDto implements AppAssetInterface
{

    /**
     * The AppAssetDto constructor.
     * 
     * @param string $basepath The basepath of the asset.
     * @param string $baseUrl The base URL of the asset.
     * @param string $version The version of the asset.
     * @param JsOptionsDto $jsOption The JS options of the asset.
     * @param array $depends The depends of the asset.
     * @param array $js The JS files of the asset.
     * @param array $css The CSS files of the asset.
     * @return void
     */
    public function __construct(
        private readonly string $basepath,
        private readonly string $baseUrl,
        private readonly string $version,
        private readonly JsOptionsInterface $jsOption,
        private readonly array $depends = [],
        private readonly array $js = [],
        private readonly array $css = []
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

    public function getJsOptions(): JsOptionsInterface
    {
        return $this->jsOption;
    }

    public function getDepends(): array
    {
        return $this->depends;
    }

    public function getJs(): array
    {
        return $this->js;
    }

    public function getCss(): array
    {
        return $this->css;
    }
}
