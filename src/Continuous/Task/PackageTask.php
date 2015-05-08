<?php
/**
 * PackageTask.php
 *
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @copyright Copyright (c) 2015 Continuous S.A. (http://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      PackageTask.php
 * @link      http://github.com/continuousphp/phing-tasks the canonical source repo
 */

namespace Continuous\Task;

/**
 * PackageTask
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class PackageTask extends AbstractTask
{

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $project;

    /**
     * @var string
     */
    protected $property;

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        
        return $this;
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @param string $property
     * @return $this
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }
    
    /**
     * Task entry point
     * @codeCoverageIgnore
     */
    public function main()
    {
        $build = $this->getClient()
            ->get('/api/projects/' . urlencode($this->getProject()) . '/builds?token=' . $this->getToken(),
                array(
                    'headers' => array(
                        'Accept' => 'application/hal+json',
                        'Origin' => 'https://app.continuousphp.com'
                    )
                ));
        
    }
}
