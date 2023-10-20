# GitHub API PHP Class
This is a PHP class that provides a simple and easy-to-use interface to interact with the GitHub API. With this class, you can perform various actions such as creating a new repository, creating a new branch, making a pull request, and more.

### Installation
To use this class in your PHP project, you can download the `GitHubApi.php` file and include it in your project. Alternatively, you can use composer to install it:

```
  composer require LennardKu/GitHubProfileBooster
```

### Usage
To use this class, you first need to create a new instance of the class and pass your GitHub access token as an argument:

``` php
  $github = new GitHubApi('your_access_token');
```

### Creating a GitHub access token
Before you can use this class, you will need to generate a GitHub access token. An access token is a unique identifier that is used to authenticate and authorize access to the GitHub API. To generate a new access token, follow these steps:

  1.Log in to your GitHub account and navigate to the Settings page.

  2. From the left-hand menu, select Developer settings and then Personal access tokens.

  3. Click the Generate new token button to create a new token.

  4. Give your token a description and set the desired permissions. Note that you should only grant the minimum permissions necessary for your use case.

  5. Click the Generate token button to create your new access token.

  6. Copy the generated access token and use it when creating a new instance of the GitHubApi class:

``` php
  $github = new GitHubApi('your_access_token');
```

### Create a new repository
To create a new repository on GitHub, you can use the `createRepository()` method:

``` php
  $github->createRepository('new-repo', 'Description of the new repo');
 ```

### Create a new branch
To create a new branch in a repository, you can use the `createBranch()` method:

``` php 
  $github->createBranch('username/repo', 'new-branch', 'master');
```

### Make a pull request
To make a new pull request from a forked repository, you can use the `makeRandomPullRequest()` method:

``` php
  $github->makeRandomPullRequest('username/repo', 'your-forked-repo');
```

### Delete all repositories
To delete all the repositories owned by the authenticated user, you can use the `deleteAllRepositories()` method:

``` php
  $github->deleteAllRepositories();
```

### Conclusion
This PHP class provides a simple and easy-to-use interface to interact with the GitHub API. By generating a GitHub access token and using the provided methods, you can perform various actions on your GitHub repositories.



 
