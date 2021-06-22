<?php

namespace Deployer;

// Include the Laravel & rsync recipes
require 'recipe/laravel.php';

set('application', 'l8');
set('repository', 'git@github.com:NookeST/l8.git');

// Hosts
host('l8')
    ->hostname('scp93.hosting.reg.ru') // Hostname or IP address
    ->stage('staging') // Deployment stage (production, staging, etc)
    ->user('avtomaty6') // SSH user
    ->set('deploy_path', '~/public_html'); // Deploy path

after('deploy:failed', 'deploy:unlock'); // Unlock after failed deploy
