<?php

namespace Jawabkom\Standard\Contract;

interface IDependencyInjector
{
    /**
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $type
     * @psalm-return RealInstanceType
     */
    public function make(string $type, array $arguments = []):mixed;
}