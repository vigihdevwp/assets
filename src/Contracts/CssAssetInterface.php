<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface CssAssetInterface
{

    public function getBasepath(): string;
    public function getBaseUrl(): string;
    public function getVersion(): string;
    public function getDepends(): array;
    public function getCss(): array;
}
