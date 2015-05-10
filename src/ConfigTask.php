<?php
/**
 * ConfigTask.php
 *
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @copyright Copyright (c) 2015 Continuous S.A. (http://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      ConfigTask.php
 * @link      http://github.com/continuousphp/phing-tasks the canonical source repo
 */

namespace Continuous\Task;

use Continuous\Sdk\Service;

/**
 * ConfigTask
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class ConfigTask extends AbstractTask
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @param  string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Task entry point
     */
    public function main()
    {
        $config = [];
        if ($this->token) {
            $config['token'] = $this->token;
        }
        
        $this->setClient(Service::factory($config));
    }
}
