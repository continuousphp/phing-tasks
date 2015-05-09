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
        $buildUrl = '/api/projects/' . urlencode($this->provider . '/' . $this->repository) . '/builds'
                  . '?token=' . $this->getToken()
                  . '&state[]=complete'
                  . '&result[]=success'
                  . '&result[]=warning';
        
        if ($this->reference) {
            $buildUrl.= '&ref=' . urlencode($this->reference);
        }
        
        $response = $this->getClient()
            ->get($buildUrl)
            ->json();
        
        $build = $response['_embedded']['builds'][0];
        
        $message = "found build $build[buildId] for reference $build[ref] created on $build[created]"
                 . " and finished with $build[result] result";
        $this->log($message);
        $this->log($build['_links']['self']['href']);

        $response = $this->getClient()
            ->get($build['_links']['self']['href'] . '/packages/deploy?token=' . $this->getToken())
            ->json();
        
        $this->getProject()->setProperty('package.url', $response['url']);
    }
}
