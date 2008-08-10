use inc::Module::Install;

name     'KaeL';
all_from 'lib/KaeL.pm';
author   'lieutar <lieutar@1dk.jp>';

build_requires 'Test::More';

auto_install;

WriteAll;

