<?php

namespace Deployer;

require 'recipe/symfony4.php';

// Project name
set('application', 'name');

// Project repository (use ssh version, starting with git@)
set('repository', 'urlVersVotreRepo');

set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', [
    'var/log',
    'var/sessions',
]);

// Writable dirs by web server
add('writable_dirs', [
    'var/log',
    'var/sessions',
]);
set('allow_anonymous_stats', false);

set('http_user', 'www-data');

// Hosts

host('51.77.158.108')
    ->stage('prod')
    ->user('debian')
    ->port(22)
    ->forwardAgent(true)
    ->set('deploy_path', '/var/www/test.com')
    ->set('branch', 'master')
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-suggest');

// Tasks
