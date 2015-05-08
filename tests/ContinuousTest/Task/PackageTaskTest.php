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

use Continuous\Task\PackageTask;

/**
 * PackageTaskTest
 *
 * @package   phing-tasks
 * @author    Frederic Dewinne <frederic@continuousphp.com>
 * @license   http://opensource.org/licenses/Apache-2.0 Apache License, Version 2.0
 */
class PackageTaskTest extends \PHPUnit_Framework_TestCase
{

    public function testProjectSetter()
    {
        $project = 'toto';
        
        $task = new PackageTask();
        $this->assertSame($task, $task->setProject($project));
        $this->assertAttributeSame($project, 'project', $task);
    }

    public function testReferenceSetter()
    {
        $reference = 'toto';
        
        $task = new PackageTask();
        $this->assertSame($task, $task->setReference($reference));
        $this->assertAttributeSame($reference, 'reference', $task);
    }

    public function testPropertySetter()
    {
        $property = 'toto';
        
        $task = new PackageTask();
        $this->assertSame($task, $task->setProperty($property));
        $this->assertAttributeSame($property, 'property', $task);
    }
    
    public function mainTest()
    {
        
    }
}
