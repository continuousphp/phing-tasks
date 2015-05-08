<?php
/**
 * ConfigTaskTest.php
 *
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @copyright Copyright (c) 2015 Continuous S.A. (http://continuousphp.com)
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 * @file      ConfigTaskTest.php
 * @link      http://github.com/continuousphp/phing-tasks the canonical source repo
 */

namespace ContinuousTest\Task;

use Continuous\Task\ConfigTask;

/**
 * ConfigTaskTest
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class ConfigTaskTest extends \PHPUnit_Framework_TestCase
{

    public function testTokenSetter()
    {
        $token = 'toto';
        
        $task = new ConfigTask();
        $this->assertSame($task, $task->setToken($token));
        $this->assertAttributeSame($token, 'token', 'Continuous\Task\AbstractTask');
    }
}
