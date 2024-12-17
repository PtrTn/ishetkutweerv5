<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config
set ('ssh_multiplexing', false);
set('repository', 'git@github.com:PtrTn/ishetkutweerv5.git');

add('shared_files', ['.env.local']);
add('shared_dirs', ['var/data']);
add('writable_dirs', []);

// Hosts
host('ishetkutweer.nl')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/ishetkutweer');

// Tasks
task('deploy:build_assets', function () {
    cd('{{release_path}}');
    run('chmod +x bin/console'); // todo, fix in a nicer way
    run('bin/console asset-map:compile');
});

// Hooks
after('deploy:symlink', 'deploy:build_assets');
after('deploy:failed', 'deploy:unlock');
