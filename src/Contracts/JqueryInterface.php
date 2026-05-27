<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface JqueryInterface
{
    public function getJsOption(): JsOptionsInterface;

    public function getHandle(): string;

    public function getSrcUri(): string;

    public function getVersion(): string|bool|null;

    public function getOptions(): array;
}
