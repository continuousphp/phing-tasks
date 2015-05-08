Feature: continuousphp package
  In order to deploy a package
  As a Developer or SysOps
  I need to be able to retrieve the URL of the last stable package for a specific GIT reference
  
  Scenario: Get the last build of master branch
    Given I've the token "cc2efee7-be03-4611-923e-065bc3dd3326"
    And the project "git-hub/continuousphp/phing-tasks"
    And the reference "/head/master"
    When I use the continuousphp package task
    Then I should retrieve a valid download url