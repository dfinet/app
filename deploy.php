<?php
namespace Deployer;
require 'recipe/common.php';
require 'recipe/composer.php';
// php5 setting
set('ssh_type', 'native');
set('ssh_multiplexing', true);
// Configuration
set('branch', 'master');
set('repository', 'git@github.com:dfinet/app.git');
set('shared_files', ['wp-content/uploads', 'wp-content/cache', 'wp-content/plugins']);
set('shared_dirs', []);
set('writable_dirs', []);
set('copy_dirs', []);
// Servers
serverList('config/deploy/servers.yml');

// ==============================
//     Deploy
// ==============================
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:copy_dirs',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);
after('deploy', 'success');
