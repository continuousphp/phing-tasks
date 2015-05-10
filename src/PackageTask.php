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
    protected $provider;

    /**
     * @var string
     */
    protected $repository;

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
     * @param string $provider
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @param string $repository
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        
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
        $projectId = $this->provider . '/' . $this->repository;
        $projectFilter = [
            'projectId' => $projectId,
            'state' => ['complete'],
            'result' => ['success', 'warning']
        ];
        
        if ($this->reference) {
            $projectFilter['ref'] = $this->reference;
        }

        // Get the build list
        $builds = $this->getClient()
            ->getBuilds($projectFilter);
        
        if (empty($builds['_embedded']['builds'])) {
            $message = 'No build found for the project "' . $projectId . '"';
            if ($this->reference) {
                $message.= ' on the reference  "' . $this->reference . '"';
            }
            throw new \BuildException($message);
        }

        // Get the package download url of the last build
        $package = $this->getClient()->getPackage([
            'projectId' => $projectId,
            'buildId' => $builds['_embedded']['builds'][0]['buildId'],
            'packageType' => 'deploy'
        ]);
        
        $this->getProject()->setProperty('package.url', $package['url']);
    }
}
