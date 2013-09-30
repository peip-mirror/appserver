<?php

/**
 * TechDivision\ApplicationServer\Api\Node\HandlerNode
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */
namespace TechDivision\ApplicationServer\Api\Node;

/**
 * DTO to transfer handler information.
 *
 * @package TechDivision\ApplicationServer
 * @copyright Copyright (c) 2013 <info@techdivision.com> - TechDivision GmbH
 * @license http://opensource.org/licenses/osl-3.0.php
 *          Open Software License (OSL 3.0)
 * @author Tim Wagner <tw@techdivision.com>
 */
class HandlerNode extends AbstractNode
{

    /**
     * The handler's formatter configuration.
     *
     * @var \TechDivision\ApplicationServer\Api\Node\FormatterNode
     * @AS\Mapping(nodeName="formatter", nodeType="TechDivision\ApplicationServer\Api\Node\FormatterNode")
     */
    protected $formatter;

    /**
     * The handler params to use.
     *
     * @var array<\TechDivision\ApplicationServer\Api\Node\ParamNode>
     * @AS\Mapping(nodeName="params/param", nodeType="array", elementType="TechDivision\ApplicationServer\Api\Node\ParamNode")
     */
    protected $params = array();

    /**
     * Returns the formatter configuration.
     *
     * @return \TechDivision\ApplicationServer\Api\Node\FormatterNode The formatter configuration node
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * Array with the handler params to use.
     *
     * @return array<\TechDivision\ApplicationServer\Api\Node\ParamNode>
     */
    public function getParams()
    {
        return $this->params;
    }
}