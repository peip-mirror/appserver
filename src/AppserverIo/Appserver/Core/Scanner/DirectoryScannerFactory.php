<?php

/**
 * \AppserverIo\Appserver\Core\Scanner\DirectoryScannerFactory
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/appserver
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Appserver\Core\Scanner;

use AppserverIo\Appserver\Core\Api\Node\ScannerNodeInterface;
use AppserverIo\Psr\ApplicationServer\ApplicationServerInterface;

/**
 * Directory scanner factory implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/appserver
 * @link      http://www.appserver.io
 */
class DirectoryScannerFactory implements ScannerFactoryInterface
{

    /**
     * Creates a new scanner instance and attaches it to the passed server instance.
     *
     * @param \AppserverIo\Psr\ApplicationServer\ApplicationServerInterface $server      The server instance to add the scanner to
     * @param \AppserverIo\Appserver\Core\Api\Node\ScannerNodeInterface     $scannerNode The scanner configuration
     *
     * @return object The scanner instance
     */
    public static function visit(ApplicationServerInterface $server, ScannerNodeInterface $scannerNode)
    {

        // load the initial context instance
        /** @var \AppserverIo\Appserver\Application\Interfaces\ContextInterface $initialContext */
        $initialContext = $server->getInitialContext();

        // iterate over the configured directories and create a scanner instance for each of them
        /** @var \AppserverIo\Appserver\Core\Api\Node\DirectoryNodeInterface $directoryNode */
        foreach ($scannerNode->getDirectories() as $directoryNode) {
            // load the reflection class for the scanner type
            $reflectionClass = new \ReflectionClass($scannerNode->getType());

            // prepare the unique scanner name
            $scannerName = sprintf('%s-%s', $scannerNode->getName(), $directoryNode->getNodeValue()->__toString());

            // prepare the scanner params
            $scannerParams = array($initialContext, $scannerName, $directoryNode->getNodeValue()->__toString());
            $scannerParams = array_merge($scannerParams, $scannerNode->getParamsAsArray());

            // register and start the scanner as daemon
            $server->bindService(ApplicationServerInterface::DAEMON, $reflectionClass->newInstanceArgs($scannerParams));
        }
    }
}
