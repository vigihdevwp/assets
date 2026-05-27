<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface StyleEnqueueInterface
{

    public function getHandle(): string;
    public function getSrcUri(): string;
    public function getDepends(): array;
    public function getVersion(): string|bool|null;
    public function getMedia(): string;
}
