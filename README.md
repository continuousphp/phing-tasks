# phing-tasks

[![Build Status](https://status.continuousphp.com/git-hub/continuousphp/phing-tasks?token=bb175a86-acb5-4f62-92b5-86d5900b6971)](https://continuousphp.com/git-hub/continuousphp/phing-tasks)

[Phing](https://www.phing.info/) tasks to consume [continuousphp](https://continuousphp.com/) API in a Phing build

## Installation

Install this package through [Composer](https://getcomposer.org/) by adding this package in the require section

```json
"require": {
    "continuousphp/phing-tasks": "~0.1"
}
```

## Import tasks in your build
```xml
<import file="./vendor/continuousphp/phing-tasks/tasks.xml"/>
```

## Tasks

1. [continuousphp-config](#1-continuousphp-config)
2. [continuousphp-package](#2-continuousphp-package)

### 1. continuousphp-config
The goal of this task is to setup your credential in order to start consuming
[continuousphp](https://continuousphp.com/) API

#### 1.1. Attributes
| Name  | Type   | Description                      | Default | Required |
| ----- | ------ | -------------------------------- | ------- | -------- |
| token | String | A valid token to consume the API | n/a     | Yes      |

#### 1.2. Example
```xml
<continuousphp-config token="my-valid-token" />
```

### 2. continuousphp-package
This task helps you to get a package url for a repository.

#### 2.1. Attributes
| Name       | Type   | Description                                              | Default | Required |
| ---------- | ------ | -------------------------------------------------------- | ------- | -------- |
| provider   | String | the repository provider platform (git-hub, bitbucket...) | n/a     | Yes      |
| repository | String | the repository name                                      | n/a     | Yes      |
| reference  | String | the GIT reference of the package                         | n/a     | No       |
| property   | String | the property in which the download URL will be defined   | n/a     | No       |

#### 2.2 Example
```xml
<continuousphp-package
            provider="git-hub"
            repository="continuousphp/phing-tasks"
            reference="/refs/heads/master"
            property="package.url" />
```