<?php

namespace Neos\ContentRepository\Core\SharedModel\Exception;

/*
 * This file is part of the Neos.ContentRepository package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */


/**
 * The exception to be thrown if a requested node aggregate does not currently exist
 *
 * @api because exception is thrown during invariant checks on command execution
 */
final class NodeAggregateCurrentlyDoesNotExist extends \DomainException
{
}
