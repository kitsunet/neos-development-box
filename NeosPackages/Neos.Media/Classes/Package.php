<?php
namespace Neos\Media;

/*
 * This file is part of the Neos.Neos package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Configuration\ConfigurationManager;
use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Package\Package as BasePackage;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Model\ImportedAssetManager;
use Neos\Media\Domain\Service\AssetService;
use Neos\Media\Domain\Service\AssetVariantGenerator;
use Neos\Media\Domain\Service\ThumbnailGenerator;

/**
 * The Media Package
 */
class Package extends BasePackage
{
    /**
     * @param Bootstrap $bootstrap The current bootstrap
     * @return void
     */
    public function boot(Bootstrap $bootstrap)
    {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();
        $dispatcher->connect(AssetService::class, 'assetCreated', function (AssetInterface $asset) use ($bootstrap) {
            $configurationManager = $bootstrap->getObjectManager()->get(ConfigurationManager::class);
            if ($configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Neos.Media.autoCreateImageVariantPresets')) {
                $bootstrap->getObjectManager()->get(AssetVariantGenerator::class)->createVariants($asset);
            }
        });
        $dispatcher->connect(AssetService::class, 'assetCreated', ThumbnailGenerator::class, 'createThumbnails');
        $dispatcher->connect(AssetService::class, 'assetCreated', ImportedAssetManager::class, 'registerCreatedAsset');
        $dispatcher->connect(AssetService::class, 'assetRemoved', ImportedAssetManager::class, 'registerRemovedAsset');
    }
}
