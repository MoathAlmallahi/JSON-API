#!/usr/bin/env bash
BASEDIR=$(dirname $0)
{
    "$BASEDIR/../vendor/bin/phpunit" --bootstrap "$BASEDIR/../vendor/autoload.php" -v "$BASEDIR/../test/" --coverage-clover=tools/coverage.xml
}