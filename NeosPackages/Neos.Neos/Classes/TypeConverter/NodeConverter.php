<?php

/*
 * This file is part of the Neos.ContentRepository package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

declare(strict_types=1);

namespace Neos\Neos\TypeConverter;

use Neos\Neos\FrontendRouting\NodeAddressFactory;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Property\PropertyMappingConfigurationInterface;
use Neos\Flow\Property\TypeConverter\AbstractTypeConverter;
use Neos\Fusion\Core\Cache\ContentCache;

/**
 * !!! Only needed for uncached Fusion segments; as in Fusion ContentCache, the PropertyMapper is used to serialize
 * and deserialize the context.
 * {@see ContentCache::serializeContext()}
 *
 * @Flow\Scope("singleton")
 * @deprecated
 */
class NodeConverter extends AbstractTypeConverter
{
    /**
     * @Flow\Inject
     * @var ContentRepositoryRegistry
     */
    protected $contentRepositoryRegistry;

    /**
     * @var array<int,string>
     */
    protected $sourceTypes = [Node::class];

    /**
     * @var string
     */
    protected $targetType = 'string';

    /**
     * @var integer
     */
    protected $priority = 1;

    /**
     * @param Node $source
     * @param string $targetType
     * @param array<string,mixed> $subProperties
     * @return mixed|\Neos\Error\Messages\Error|string|null
     */
    public function convertFrom(
        $source,
        $targetType = null,
        array $subProperties = [],
        PropertyMappingConfigurationInterface $configuration = null
    ) {
        $contentRepository = $this->contentRepositoryRegistry->get(
            $source->subgraphIdentity->contentRepositoryId
        );
        return NodeAddressFactory::create($contentRepository)->createFromNode($source)->serializeForUri();
    }
}
