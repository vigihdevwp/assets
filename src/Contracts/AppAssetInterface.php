<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;


interface AppAssetInterface
{

    public function getBasepath(): string;
    public function getBaseUrl(): string;
    public function getVersion(): string;
    public function getJsOptions(): JsOptionsInterface;
    public function getDepends(): array;
    public function getJs(): array;
    public function getCss(): array;
}
