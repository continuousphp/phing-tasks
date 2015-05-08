<?php

namespace Continuous\Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class TaskContext implements Context, SnippetAcceptingContext
{
    const PHING_BIN_PATH = 'vendor/bin/phing';
    
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $project;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $lastOutput;
    
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
     * @Given I've the token :token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @Given the project :project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @Given the reference :reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @When I use the continuousphp package task
     */
    public function runPackageTask()
    {
        $command = self::PHING_BIN_PATH . ' config package'
                 . " -Dtoken=" . $this->token
                 . " -Dproject=" . $this->project
                 . " -Dreference=" . $this->reference;
        
        exec($command, $output, $return);
        
        if ($return) {
            throw new \RuntimeException(implode(PHP_EOL, $output), $return);
        }
        
        $this->lastOutput = implode(PHP_EOL, $output);
    }

    /**
     * @Then I should retrieve a valid download url
     */
    public function isValidDownloadUrl()
    {
        $regex = "/---PACKAGE_URL:(.*)---/";
        \PHPUnit_Framework_Assert::assertRegExp($regex, $this->lastOutput);
        
        preg_match($regex, $this->lastOutput, $matches);
        $url = $matches[1];
        
        \PHPUnit_Framework_Assert::assertNotEquals('${package.url}', $url);
    }
}
