<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface ScriptEnqueueInterface
{
    public function getHandle(): string;

    public function getSrcUri(): string;

    public function getDepends(): array;

    public function getVersion(): string|bool|null;

    public function getOptions(): array;

    public function getJsOption(): JsOptionsInterface;
}
