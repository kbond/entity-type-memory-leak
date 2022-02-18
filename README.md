# Doctrine Bridge EntityType Memory Leak Reproducer

## Setup

```bash
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:create
```

## Homepage Test

*NO MEMORY LEAKS*

Sanity check to ensure no memory leaks on simple homepage test.

```bash
# following: ~ same memory usage
TEST_RUNS=20 bin/phpunit --filter=homepage
TEST_RUNS=60 bin/phpunit --filter=homepage
```

## New Post Test

*MEMORY LEAKS*

This demonstrates the problem.

```bash
# following: dramatically different memory usage
TEST_RUNS=20 bin/phpunit --filter=new_post
TEST_RUNS=60 bin/phpunit --filter=new_post
```
