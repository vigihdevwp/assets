<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface JsOptionsInterface extends ArrayAbleInterface
{
    public function getStrategy(): ?string;

    public function getInFooter(): bool;
}
