Feature: continuousphp package
  In order to deploy a package
  As a Developer or SysOps
  I need to be able to retrieve the URL of the last stable package for a specific GIT reference
  
  Scenario: Get the last build of master branch
    Given I've the token "e391f57ddd27bb37097a5c46a47776289cf1eff7"
    And the provider "git-hub"
    And the repository "continuousphp/phing-tasks"
    And the reference "refs/heads/master"
    When I use the continuousphp package task
    Then I should retrieve a valid download url