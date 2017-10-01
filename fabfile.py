from __future__ import with_statement
from fabric.api import local, settings, abort, run, cd, env, put
from fabric.contrib.console import confirm
import os
import fnmatch
import tarfile
import tempfile

#TODO: break this into multiple files and add to deploy directory
#TODO: add gitignore processing when file is encountered (this will clean up the excludes list) https://github.com/tsileo/dirtools

dest_dir = '/var/www'
env.hosts = ['enkii.io']
env.user = 'ubuntu'
env.key_filename = './enkii.pem'

excludes = (
    env.key_filename,
    './.vagrant',
    '.git',
    './node_modules',
    './tests',
    './vendor',
    '.env',
    '.env.example',
    '.gitattributes',
    '.gitignore',
    '*/fabfile.*',
    'package.json',
    'phpunit.xml',
    'Procfile',
    'README.md',
    'Vagrantfile',
    'webpack.mix.js',
    'yarn.lock',
    './public/hot',
    './public/storage',
    './storage/*.key',
    './.idea',
    'Homestead.json',
    'Homestead.yaml',
    'npm-debug.log',
    'yarn-error.log',
    'npm-debug.log',
    'dani_notes.txt',
    '.DS_Store',
    './bootstrap/cache/*',
    './database/*.sqlite',
    './public/mix-manifest.json',
    './storage/app/*',
    './storage/app/public/*',
    './storage/framework/config.php',
    './storage/framework/routes.php',
    './storage/framework/schedule-*',
    './storage/framework/compiled.php',
    './storage/framework/services.json',
    './storage/framework/events.scanned.php',
    './storage/framework/routes.scanned.php',
    './storage/framework/down',
    './storage/framework/cache/*',
    './storage/framework/sessions/*',
    './storage/framework/testing/*',
    './storage/framework/views/*',
    './storage/logs/*',
    './postman_token.txt'
)

def _check_filter(filter, full_path):
    ret = (filter in full_path)
    if '*' in filter:
        ret = ret | fnmatch.fnmatch(full_path, filter)

    return ret

# new method to filter
# def _check_filter(info):
#     name = './' + info.name
#     ret = False
#     for filter in excludes:
#         ret = (filter in name)
#         if '*' in filter:
#             ret = ret | fnmatch.fnmatch(name, filter)
#         if ret:
#             info = None
#             break
#
#     return info

def build(type='prod'):
    """
    Compile assets into the public directory

    Keyword arguments:
    type -- environment to build, dev or prod (default prod)
    """
    if type != 'prod' and type != 'dev':
        print 'must specify either dev or prod'
        return False

    local('npm run ' + type)
    return True

def deploy(type='prod', do_migrate=False):
    """
    Compile assets, copy files to server and optionally run migrations

    Keyword arguments:
    type         -- environment to build, dev or prod (default prod)
    do_migration -- run the database migrations (default False)
    """
    if not build(type):
        return

    # newer way of doing this, cleaner but slower... too slow for me
    # with tarfile.open('test.tar', mode='w') as out:
    #     for root, subdirs, files in os.walk('.', topdown=True):
    #         new_root = ''
    #         if root != '.' and root != './':
    #             new_root = os.path.normpath(root)
    #             out.add(new_root, recursive=False, filter=_check_filter)
    #         for file in files:
    #             out.add(os.path.join(new_root, file), filter=_check_filter)

    temp_file = ''
    try:
        temp_file = os.path.join(tempfile._get_default_tempdir(), next(tempfile._get_candidate_names()))
        # doing it this way because it's faster!!! SPEED BABY SPEED!!!
        files_to_copy = {}
        for root, subdirs, files in os.walk('.', topdown=True):
            process = True
            root_path = root.replace(os.sep, '/')
            for filter in excludes:
                if _check_filter(filter, root_path):
                    process = False
                    break

            if not process:
                continue

            files_to_copy[root] = []

            for file in files:
                process = True
                full_path = os.path.join(root, file).replace(os.sep, '/')
                for filter in excludes:
                    if _check_filter(filter, full_path):
                        process = False
                        break

                if process:
                    files_to_copy[root].append(file)

        with tarfile.open(temp_file, mode='w') as out:
            for root, files in files_to_copy.iteritems():
                new_root = ''
                if root != '.' and root != './':
                    new_root = os.path.normpath(root)
                    out.add(new_root, recursive=False)
                for file in files:
                    out.add(os.path.join(new_root, file))

        run('sudo rm -rf ' + dest_dir + '/*')
        put(temp_file, dest_dir + '/' + 'deploy.tar', use_sudo=True)

    finally:
        if os.path.isfile(temp_file):
            os.remove(temp_file)

    with cd(dest_dir):
        run('sudo tar -xvf ./deploy.tar')
        run('sudo rm -rf ./deploy.tar')
        run('sudo chown -R www-data:www-data ./*')
        run('sudo chown -R root:root ./public')
        run('sudo composer install --no-dev --optimize-autoloader')
        if do_migrate:
            run('php artisan migrate')

def init():
    """
    Reset database, initialize passport and seed the new database
    This will produce a postman_token.txt file containing the admin user token
    """
    local('php artisan db:drop');
    local('php artisan migrate');
    local('php artisan passport:install');
    local('php artisan db:seed');
