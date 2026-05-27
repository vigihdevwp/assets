<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Contracts;

interface ScriptLocalizeInterface
{
    public function getHandle(): string;
    public function getActionPrefix(): string;
    public function getVariableName(): string;
    public function getNonce(): string;
    public function getActions(): array;
    public function getDepends(): array;
}
