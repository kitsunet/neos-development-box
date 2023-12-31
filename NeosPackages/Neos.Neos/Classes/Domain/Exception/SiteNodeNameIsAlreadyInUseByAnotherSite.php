<?php

/*
 * This file is part of the Neos.Neos package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

declare(strict_types=1);

namespace Neos\Neos\Domain\Exception;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Flow\Annotations as Flow;

#[Flow\Proxy(false)]
final class SiteNodeNameIsAlreadyInUseByAnotherSite extends \DomainException
{
    public static function butWasAttemptedToBeClaimed(NodeName $nodeName): self
    {
        return new self(
            'Site node name ' . $nodeName->value . ' is already in use by another site',
            1651962963
        );
    }
}
