# phpp

phpp is basic class library in PHP

[![Build Status](https://travis-ci.org/oubakiou/phpp.svg?branch=master)](https://travis-ci.org/oubakiou/phpp)

## Arr

### basic usage

https://github.com/oubakiou/phpp/blob/master/tests/ArrTest.php#L287

- public static function ofBools(array $array): self
- public static function ofInts(array $array): self
- public static function ofArrays(array $array): self
- public static function ofStrings(array $array): self
- public static function ofNumerics(array $array): self
- public static function ofScalars(array $array): self
- public static function ofFloats(array $array): self
- public static function ofCallables(array $array): self
- public static function ofArrs(array $array): self
- public function toArray(): array
- public function toString(): string
- public function equals(self $arr): bool
- public function getValidator(): ? callable
- public function getCount()
- public function getHead()
- public function getLast()
- public function append(self $that): self
- public function head()
- public function tail(): self
- public function init(): self
- public function last()
- public function foldLeft(callable $op, $z)
- public function foldRight(callable $op, $z)
- public function reduceLeft(callable $op)
- public function reduceRight(callable $op)
- public function foreach(callable $op): void
- public function filter(callable $p = null): self
- public function filterNot(callable $p): self
- public function drop(int $n): self
- public function dropWhile(callable $p): self
- public function take(int $n): self
- public function takeWhile(callable $p): self
- public function map(callable $f, string $builtinValidatorName = '', callable $validator = null): self
- public function flatMap(callable $f, string $builtinValidatorName = '', callable $validator = null): self
- public function flatten(): self
- public function collect(callable $p, callable $f): self
- public function splitAt(int $n): self
- public function slice(int $from, int $untile): self
- public function partition(callable $p): self
- public function span(callable $p): self
- public function groupBy(callable $f) :self
- public function unzip(): self
- public function find(callable $p)
- public function exists(callable $p): bool
- public function forall(callable $p): bool
- public function count(callable $p = null): int
- public function size(): int
- public function length(): int
- public function min(): int
- public function minFloat(): float
- public function max(): int
- public function maxFloat(): float
- public function mkString(string $string1, string $string2 = '', string $string3 = ''): string
- public function dropRight($n): self
- public function sameElements(self $that): bool
- public function zip(self $that): self
- public function zipWithIndex(): self
- public function apply($key)
- public function contains($elem): bool
- public function diff(self $that): self
- public function startsWith(self $that): bool
- public function endsWith(self $that): bool
- public function indexOf($elem): int
- public function isDefinedAt($key): bool
- public function indices(): self
- public function distinct(): self
- public function reverse(): self
- public function reverseMap(callable $f, string $builtinValidatorName = '', callable $validator = null)
- public function sorted(): self
- public function sortWith(callable $lt): self
- public function patch(int $from, self $that, int $replaced)
- public function updated(int $n, $elem): self
- public function cons($elem): self
- public function getOrElse($key, $default = null)
- public function keys(): self
- public function values(): self

### benchmark

https://github.com/oubakiou/phpp/blob/master/tests/ArrBenchTest.php#L18

#### enabled assert

```
ouba-no-MacBook-Air:phpp ouba$ vendor/bin/phpunit tests/ArrBenchTest.php 
PHPUnit 5.7.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.1.0
Configuration: /Users/ouba/Desktop/phpp/phpunit.xml

.                                                                   1 / 1 (100%)

bench start

plain          0001 : 75 ms (usage 4MB)
array_function 0002 : 249 ms (usage 4MB)
Arr            0003 : 851 ms (usage 4MB)

bench end



Time: 2.43 seconds, Memory: 6.00MB

OK (1 test, 2 assertions)
```

#### disabled assert

```
ouba-no-MacBook-Air:phpp ouba$ php -d zend.assertions=0 `which vendor/bin/phpunit` tests/ArrBenchTest.php 
PHPUnit 5.7.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.1.0
Configuration: /Users/ouba/Desktop/phpp/phpunit.xml

.                                                                   1 / 1 (100%)

bench start

plain          0001 : 84 ms (usage 4MB)
array_function 0002 : 239 ms (usage 4MB)
Arr            0003 : 281 ms (usage 4MB)

bench end



Time: 1.22 seconds, Memory: 4.00MB

OK (1 test, 2 assertions)
```
