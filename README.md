# Doctrine Bridge EntityType Memory Leak Reproducer

### Homepage Test (`main` branch)

*NO MEMORY LEAKS*

Sanity check to ensure no memory leaks on simple homepage test.

```bash
# following: ~ same memory usage
TEST_RUNS=20 bin/phpunit --filter=homepage
TEST_RUNS=60 bin/phpunit --filter=homepage
```

### New Post Test (`main` branch)

*MEMORY LEAKS*

This demonstrates the problem.

```bash
# following: dramatically different memory usage
TEST_RUNS=20 bin/phpunit --filter=new_post
TEST_RUNS=60 bin/phpunit --filter=new_post
```

### New Post Test (`without-entity-type` branch)

*NO MEMORY LEAKS*

This branch removes the `EntityType` form the form.

```bash
git checkout without-entity-type

# following: ~ same memory usage
TEST_RUNS=20 bin/phpunit --filter=new_post
TEST_RUNS=60 bin/phpunit --filter=new_post
```


### New Post Test (`doctrine-bridge-5.0` branch)

*NO MEMORY LEAKS*

This branch locks `symfony/doctrine-bridge` at `5.0.11`.

```bash
git checkout doctrine-bridge-5.0
composer install

# following: ~ same memory usage
TEST_RUNS=20 bin/phpunit --filter=new_post
TEST_RUNS=60 bin/phpunit --filter=new_post
```
