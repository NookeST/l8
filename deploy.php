<?php

namespace Deployer;

// Include the Laravel & rsync recipes
require 'recipe/laravel.php';
require 'recipe/rsync.php';

set('application', 'l8');
set('ssh_multiplexing', true); // Speeds up deployments

set(
    'rsync_src',
    function () {
        return __DIR__; // If your project isn't in the root, you'll need to change this.
    }
);


// Hosts
host('l8')
    ->hostname('scp93.hosting.reg.ru') // Hostname or IP address
    ->stage('staging') // Deployment stage (production, staging, etc)
    ->user('avtomaty6') // SSH user
    ->set('deploy_path', '~/public_html'); // Deploy path


// Set up a deployer task to copy secrets to the server.
// Since our secrets are stored in GitHub, we can access them as env vars.
task(
    'deploy:secrets',
    function () {
        file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
        upload('.env', get('deploy_path') . '/shared');
    }
);


after('deploy:failed', 'deploy:unlock'); // Unlock after failed deploy
