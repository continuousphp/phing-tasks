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
    protected $provider;

    /**
     * @var string
     */
    protected $repository;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $state;

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
     * @Given the provider :provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @Given the repository :repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Given the reference :reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @Given the state :state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @When I use the continuousphp package task
     */
    public function runPackageTask()
    {
        $command = self::PHING_BIN_PATH . ' config package'
                 . " -Dtoken=" . $this->token
                 . " -Dprovider=" . $this->provider
                 . " -Drepository=" . $this->repository
                 . " -Dreference=" . $this->reference;

        exec($command, $output, $return);

        if ($return) {
            throw new \RuntimeException(implode(PHP_EOL, $output), $return);
        }
        
        $this->lastOutput = implode(PHP_EOL, $output);
    }

    /**
     * @When I use the continuousphp package-with-state task
     */
    public function runPackageWithStateTask()
    {
        $command = self::PHING_BIN_PATH . ' config package-with-state'
            . " -Dtoken=" . $this->token
            . " -Dprovider=" . $this->provider
            . " -Drepository=" . $this->repository
            . " -Dreference=" . $this->reference
            . " -Dstate=" . $this->state;

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
        
        \PHPUnit_Framework_Assert::assertNotEquals('${package.url}', $url, $this->lastOutput);
    }
}
