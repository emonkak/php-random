# random.php

random.php is a random number generator.

It provides a PHP native implementation of the "Mersenne Twister" and "Xorshift" algorithm.

This Mersenne Twister algorithm is compatible to the build-in `mt_rand()`.

# Requirements

- PHP 5.0 or higher
- [Composer](http://getcomposer.org/)

# Licence

MIT Licence

# Examples

```php
require __DIR__ . '/vendor/autoload.php';

use Random\MersenneTwister;
use Random\XorShift;

$seed = 100;

$r1 = new MersenneTwister($seed);
$r1->range(0, 100);  // is between 0 and 100
$r1->normal(0, 1);  // is a standard normal distribution

$r2 = new Xorshift($seed);
$r2->shuffle(range(0, 100));  // shuffle array

$r3 = new MersenneTwisterNative($seed);  // build-in mt_rand() wrapper
$r3->range(0, 100);  // is between 0 and 100
```

# Available random generator methods

- `float random()`
- `int range(int $min, int $max)`
- `array shuffle(array $xs)`
- `float uniform(float $min, float $max)`
- `float exponential(float $lambda)`
- `float normal(float $mean, float $sigma)`
- `float bernoulli(float $probability)`
- `float binomial(int $n, float $probability)`
- `float poisson(float $lambda)`
