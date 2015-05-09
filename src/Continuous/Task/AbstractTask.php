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

use GuzzleHttp\Client;

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
     * @var string
     */
    static protected $token;

    /**
     * @var Client
     */
    static protected $client;

    /**
     * @return string
     */
    protected function getToken()
    {
        return self::$token;
    }

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
        if (is_null(self::$client)) {
            $this->setClient(new Client(
                array(
                    'base_url' => 'https://api.continuousphp.com/',
                    'defaults' => array(
                        'headers' => array(
                            'Accept' => 'application/hal+json',
                        )
                    )
                )
            ));
        }
        
        return self::$client;
    }
}
