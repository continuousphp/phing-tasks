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

/**
 * AbstractTask
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
abstract class AbstractTask extends \Task
{
    /**
     * @var string
     */
    static protected $token;

    /**
     * @param  string $token
     * @return $this
     */
    public function setToken($token)
    {
        self::$token = $token;

        return $this;
    }

    /**
     * @return string
     */
    protected function getToken()
    {
        return self::$token;
    }
}
