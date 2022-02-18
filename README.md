# Doctrine Bridge EntityType Memory Leak Reproducer

### Homepage Test (`5.4` branch)

*NO MEMORY LEAKS*

Sanity check to ensure no memory leaks on simple homepage test.

```bash
# following: ~ same memory usage
TEST_RUNS=20 bin/phpunit --filter=homepage
TEST_RUNS=60 bin/phpunit --filter=homepage
```

### New Post Test (`5.4` branch)

*MEMORY LEAKS*

This demonstrates the problem.

```bash
# following: dramatically different memory usage
TEST_RUNS=20 bin/phpunit --filter=new_post
TEST_RUNS=60 bin/phpunit --filter=new_post
```
