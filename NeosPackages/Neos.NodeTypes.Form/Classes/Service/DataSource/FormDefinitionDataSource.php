<?php
namespace Neos\NodeTypes\Form\Service\DataSource;

/*
 * This file is part of the Neos.NodeTypes.Form package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\Flow\Annotations as Flow;

class FormDefinitionDataSource extends AbstractDataSource
{

    /**
     * @var string
     */
    protected static $identifier = 'neos-nodetypes-form-definitions';

    /**
     * @Flow\Inject
     * @var \Neos\Form\Persistence\YamlPersistenceManager
     */
    protected $yamlPersistenceManager;

    /**
     * @param Node|null $node
     * @param array $arguments
     * @return \Neos\Flow\Persistence\QueryResultInterface
     */
    public function getData(Node $node = null, array $arguments = [])
    {
        $formDefinitions['']['label'] = '';
        $forms = $this->yamlPersistenceManager->listForms();

        foreach ($forms as $form) {
            $formDefinitions[$form['identifier']]['label'] = $form['name'];
        }

        return $formDefinitions;
    }
}
