<?php
/**
 * Created by PhpStorm.
 * User: ouba
 * Date: 2016/12/10
 * Time: 17:48.
 */

namespace oubakiou\phpp;

class ArrBenchTest extends \PHPUnit_Framework_TestCase
{
    public function testBench($n = 1000)
    {
        echo "\n\nbench start\n\n";
        $range = range(0, 10000);
        $functions = [
            'plain         ' => function () use ($range) {
                $sum = 0;
                foreach ($range as $v) {
                    if ($v % 2) {
                        continue;
                    }
                    $v **= 2;
                    if ($v <= 20) {
                        continue;
                    }

                    $sum += $v;
                }

                return $sum;
            },
            'array_function' => function () use ($range) {
                return array_sum(
                    array_filter(
                        array_map(
                            function ($v) {
                                return $v ** 2;
                            },
                            array_filter($range, function ($v) {
                                return $v % 2 === 0;
                            })
                        ),
                        function ($v) {
                            return $v > 20;
                        }
                    )
                );
            },
            'Arr           ' => function () use ($range) {
                return Arr::ofInts($range)
                    ->filter(function ($v) {
                        return $v % 2 === 0;
                    })
                    ->map(function ($v) {
                        return $v ** 2;
                    })
                    ->filter(function ($v) {
                        return $v > 20;
                    })
                    ->reduceLeft(function ($a, $b) {
                        return $a += $b;
                    });
            },
        ];

        self::bench();
        foreach ($functions as $functionLabel => $function) {
            for ($i = 0; $i <= $n; ++$i) {
                $function();
            }
            self::bench($functionLabel);
        }
        echo "\nbench end\n\n";

        $result = [];
        foreach ($functions as $functionLabel => $function) {
            for ($i = 0; $i <= $n; ++$i) {
                $result[$functionLabel] = $function();
            }
        }
        Arr::ofInts($result)->reduceLeft(function ($a, $b) {
            $this->assertEquals($a, $b);
            return $b;
        });
    }

    private static function bench($label = '')
    {
        static $start;
        if (!$start) {
            $start = microtime(true);

            return;
        }

        static $count = 0;
        ++$count;

        $now = microtime(true);
        printf(
            "%s %04d : %s ms (usage %sMB)\n",
            $label,
            $count,
            number_format(ceil(($now - $start) * 1000)),
            number_format(ceil((memory_get_usage(true) / 1024 / 1024)))
        );
        $start = $now;
    }
}
