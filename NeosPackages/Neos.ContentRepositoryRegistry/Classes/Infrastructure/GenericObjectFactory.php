<?php
declare(strict_types=1);
namespace Neos\ContentRepositoryRegistry\Infrastructure;

/*
 * This file is part of the Neos.ContentRepository package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
final class GenericObjectFactory
{
    /**
     * @param class-string $className
     */
    public function create(string $className, mixed ...$arguments): object
    {
        return new $className(...$arguments);
    }
}
