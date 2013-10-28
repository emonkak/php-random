# Random.php

[![Build Status](https://travis-ci.org/emonkak/random.php.png)](https://travis-ci.org/emonkak/random.php)
[![Coverage Status](https://coveralls.io/repos/emonkak/random.php/badge.png)](https://coveralls.io/r/emonkak/random.php)

Random.php is a random number generator.

It provides pseudo-random number Generators and random number distributions.

## Requirements

- PHP 5.3 or higher
- [Composer](http://getcomposer.org/)

## Licence

MIT Licence

## Example

```php
use Random\Engine\MT19937Engine;
use Random\Distribution\NormalDistribution;

$seed = 100;  // Initial seed
$engine = new MT19937Engine($seed);  // Mersenne Twister engine
$distribution = new NormalDistribution(0, 1);  // Standard normal distribution

$distribution->generate($engine);  // Generate a random number with normal distribution
```

## Engine

- `MT19937Engine`

	This is full-compatible to the build-in `mt_rand()`.

- `XorShift128Engine`

## Distribution

- `BernoulliDistribution`
- `BinomialDistribution`
- `DiscreteDistribution`
- `DistributionIterator`
- `NormalDistribution`
- `UniformIntDistribution`
- `UniformRealDistribution`
