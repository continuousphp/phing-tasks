<?php
/**
 * AbstractTask.php
 *
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @copyright Copyright (c) 2015 Continuous S.A. (http://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      AbstractTask.php
 * @link      http://github.com/continuousphp/phing-tasks the canonical source repo
 */

namespace Continuous\Task;

use Continuous\Sdk\Client;
use Continuous\Sdk\Service;

/**
 * AbstractTask
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
abstract class AbstractTask extends \ProjectComponent
{
    /**
     * @var Client
     */
    static protected $client;

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        self::$client = $client;
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        // If no client has been set previously, default to a client without an
        // access token. This is useful for accessing public repositories.
        if (self::$client === NULL) {
          $this->setClient(Service::factory([]));
        }
        return self::$client;
    }
}
