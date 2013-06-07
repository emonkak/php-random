<?php

namespace Random;

abstract class AbstractRandom
{
    /**
     * @param  int  Initial seed
     */
    public function __construct($seed = null)
    {
        if ($seed === null) {
            // It is the default seed generation algorithm of PHP.
            $seed = (time() * getmypid()) ^ (1000000.0 * lcg_value());
        }

        $this->initialize($seed);
    }

    /**
     * Initialize the random generator.
     *
     * @param   int  Initial seed
     * @return  void
     */
    abstract public function initialize($seed);

    /**
     * Generate the random number.
     * This generated number depends on the implementation.
     *
     * @return  int
     */
    abstract public function generate();

    /**
     * Return the minimum number that will be generated.
     *
     * @return  int
     */
    public function minimum()
    {
        return 0;
    }

    /**
     * Return the maximum number that will be generated.
     *
     * @return  int
     */
    abstract public function maximum();

    /**
     * Return a random number of between 0.0 and 1.0.
     *
     * @return  float
     */
    public function random()
    {
        return $this->generate() / ($this->maximum() - $this->minimum() + 1.0);
    }

    /**
     * Return a random number of between a start number and an end number.
     *
     * @param   int  $min
     * @param   int  $max
     * @return  int
     */
    public function range($min, $max)
    {
        return (int) floor($min + ($max - $min + 1.0) * $this->random());
    }

    /**
     * Shuffle an array.
     *
     * @param   array  $xs
     * @return  array
     */
    final public function shuffle($xs)
    {
        $i = count($xs);

        while (--$i) {
            $j = $this->range(0, $i);
            $tmp = $xs[$i];
            $xs[$i] = $xs[$j];
            $xs[$j] = $tmp;
        }

        return $xs;
    }

    /**
     * Sample a array value by indices.
     *
     * @param   array       $xs
     * @return  mixed|null
     */
    final public function sample($xs)
    {
        $i = $this->range(0, count($xs));
        return isset($xs[$i]) ? $xs[$i] : null;
    }

    /**
     * Sample a array value by keys.
     *
     * @param   array       $xs
     * @return  mixed|null
     */
    final public function sampleByKey($xs)
    {
        $k = $this->sample(array_keys($xs));
        return isset($xs[$k]) ? $xs[$k] : null;
    }

    /**
     * Sample from a uniform distribution.
     *
     * @param   float  $min
     * @param   float  $max
     * @return  float
     */
    final public function uniform($min, $max)
    {
        return $min + ($max - $min) * $this->random();
    }

    /**
     * Sample from a exponential distribution.
     *
     * @param   float  $lambda
     * @return  float
     */
    final public function exponential($lambda)
    {
        return -$lambda * log(1.0 - $this->random());
    }

    /**
     * Samples from a normal (Gaussian) distribution.
     *
     * @param   float  $mean
     * @param   float  $sigma
     * @return  float
     */
    final public function normal($mean, $sigma)
    {
        $r1 = $this->random();
        $r2 = $this->random();
        while ($r1 == 0) $r1 = $this->random();
        return $sigma * sqrt(-2 * log($r1)) * sin(2 * M_PI * $r2) + $mean;
    }

    /**
     * Sample from a bernoulli distribution.
     *
     * @param   float  $probability
     * @return  int
     */
    final public function bernoulli($probability)
    {
        return $this->random() <= $probability ? 1 : 0;
    }

    /**
     * Sample from a binomial distribution.
     *
     * @param   int    $n
     * @param   float  $probability
     * @return  int
     */
    final public function binomial($n, $probability)
    {
        $count = 0;
        while ($n-- > 0) $this->random() <= $probability and $count++;
        return $count;
    }

    /**
     * Sample from a poisson distribution.
     *
     * @param   float  $lambda
     * @return  float
     */
    final public function poisson($lambda)
    {
        $base = exp($lambda);
        $count = -1;

        while ($base > 1.0) {
            $base *= $this->random();
            $count++;
        }

        return $count;
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
