# Random.php

[![Build Status](https://travis-ci.org/emonkak/random.php.png)](https://travis-ci.org/emonkak/random.php)
[![Coverage Status](https://coveralls.io/repos/emonkak/random.php/badge.png)](https://coveralls.io/r/emonkak/random.php)

Random.php is a random number library.

It provides pseudo-random number generators and probability distributions.

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
$engine = new MT19937Engine($seed);  // 32bit Mersenne Twister engine
$distribution = new NormalDistribution(0, 1);  // Standard normal distribution

// Generate a random number with the normal distribution.
$distribution->generate($engine);
```

## Engine

- `KnuthBEngine`

- `LinearCongruentialEngine`

- `MinstdRand0Engine`

- `MinstdRandEngine`

- `MT19937Engine`

	The random generator engine according to [Mersenne Twister](http://en.wikipedia.org/wiki/Mersenne_twister).
	It is full-compatible to the built-in `mt_rand()`.

	```php
	// Also, the initial seed algorithm is full-compatible to the built-in `mt_srand()`
	$engine = new MT19937Engine(/* $seed */);

	// Reset the seed.
	$engine->seed(1234);

	// Get a next random number from the current generator state.
	$number = $engine->next();  // as int
	$number = $engine->nextDouble();  // as float

	// Get the minimum and maximum number which generate a value by the engine.
	$minimum = $engine->min();
	$maximum = $engine->max();

	// Iterate the generator engine.
	foreach (new LimitIterator($engine, 0, 100) as $n) {
	}
	```

- `MTRandWrapper`

	The wrapper for the built-in `mt_rand()`.

- `ShuffleOrderEngine`

- `XorShift128Engine`

	The random generator engine according to [Xorshift](http://en.wikipedia.org/wiki/XorShift) 128 bit algorithm.

	```php
	// If unspecified the seed, it is always specified the default seed value.
	$engine = new XorShift128Engine(/* $seed */);

	// See also `MT19937Engine`.
	```

## Distribution

- `BernoulliDistribution`
- `BinomialDistribution`
- `DiscreteDistribution`
- `DistributionIterator`
- `ExponentialDistribution`
- `GammaDistribution`
- `GeometricDistribution`
- `LogNormalDistribution`
- `NormalDistribution`
- `PiecewiseConstantDistribution`
- `PiecewiseLinerDistribution`
- `UniformIntDistribution`
- `UniformRealDistribution`
