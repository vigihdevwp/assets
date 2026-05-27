<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface JsModuleInterface
{
    public function getBasepath(): string;

    public function getBaseUrl(): string;

    public function getVersion(): string;

    public function getJs(): array;

    public function getJsOptions(): JsOptionsInterface;

    public function getDepends(): array;
}
