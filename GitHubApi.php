<?php

class GitHubProfileBooster
{
    private $username;
    private $repository;
    private $token;

    public function __construct($username, $repository, $token)
    {
        $this->username = $username;
        $this->repository = $repository;
        $this->token = $token;
    }

    public function getRandomEmoji()
    {
        $emojis = [
            '😀', '😃', '😄', '😁', '😆', '😅', '😂',
            '🤣', '😊', '😇', '🙂', '🙃', '😉', '😌',
            '😍', '🥰', '😘', '😗', '😙', '😚', '😋',
            '😛', '😜', '😝', '🤑', '🤗', '🤔', '🤭',
            '🤫', '🤥', '😶', '😐', '😑', '😬', '🙄',
            '😮', '😱', '😨', '😰', '😢', '😥', '🤤',
            '😭', '😓', '😩', '😫', '🥱', '😴', '🤢',
            '🤮', '🤧', '😷', '🥴', '🥵', '🥶', '😵',
            '🤯', '🤠', '🥳', '😎', '🤓', '🧐', '😕',
            '😟', '🙁', '😮‍💨', '😷‍♂️', '😷‍♀️', '💩'
        ];
        return $emojis[array_rand($emojis)];
    }

    public function makeRandomPullRequest()
    {
        $url = "https://api.github.com/repos/{$this->username}/{$this->repository}/forks";
        $headers = [
            'Authorization: token ' . $this->token,
            'User-Agent: PHP'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result === false) {
            return false;
        }

        $fork = json_decode($result, true);

        $url = "https://api.github.com/repos/{$fork['full_name']}/contents/test-file.txt";
        $headers = [
            'Authorization: token ' . $this->token,
            'User-Agent: PHP'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result === false) {
            return false;
        }

        $file = json_decode($result, true);
        $content = base64_decode($file['content']);

        $emoji = $this->getRandomEmoji();
        $message = "Random commit $emoji";
        $newContent = "$content\n$message";

        $url = "https://api.github.com/repos/{$fork['full_name']}/contents/test-file.txt";
        $headers = [
        'Authorization: token ' . $this->token,
        'User-Agent: PHP',
        'Content-Type: application/json'
        ];
        $data = [
        'message' => $message,
        'content' => base64_encode($newContent),
        'sha' => $file['sha']
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
          if ($result === false) {
        return false;
    }

    return true;
}

public function deleteAllRepositories()
{
    $url = "https://api.github.com/user/repos";
    $headers = [
        'Authorization: token ' . $this->token,
        'User-Agent: PHP',
        'Accept: application/vnd.github.v3+json'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    if ($result === false) {
        return false;
    }

    $repos = json_decode($result, true);

    foreach ($repos as $repo) {
        $url = "https://api.github.com/repos/{$repo['full_name']}";
        $headers = [
            'Authorization: token ' . $this->token,
            'User-Agent: PHP',
            'Accept: application/vnd.github.v3+json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result === false) {
            return false;
        }
    }

    return true;
}
}
