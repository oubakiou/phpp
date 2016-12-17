# phpp

phpp is basic class library in PHP

[![Build Status](https://travis-ci.org/oubakiou/phpp.svg?branch=master)](https://travis-ci.org/oubakiou/phpp)
[![License](https://poser.pugx.org/oubakiou/phpp/license)](https://packagist.org/packages/oubakiou/phpp)
[![Latest Stable Version](https://poser.pugx.org/oubakiou/phpp/v/stable)](https://packagist.org/packages/oubakiou/phpp)

## Arr

### basic usage

https://github.com/oubakiou/phpp/blob/master/tests/ArrTest.php#L287

- static ofBools(array $array): self
- static ofInts(array $array): self
- static ofArrays(array $array): self
- static ofStrings(array $array): self
- static ofNumerics(array $array): self
- static ofScalars(array $array): self
- static ofFloats(array $array): self
- static ofCallables(array $array): self
- static ofArrs(array $array): self
- toArray(): array
- toString(): string
- equals(self $arr): bool
- getValidator(): ? callable
- getCount()
- getHead()
- getLast()
- append(self $that): self
- head()
- tail(): self
- init(): self
- last()
- foldLeft(callable $op, $z)
- foldRight(callable $op, $z)
- reduceLeft(callable $op)
- reduceRight(callable $op)
- foreach(callable $op): void
- filter(callable $p = null): self
- filterNot(callable $p): self
- drop(int $n): self
- dropWhile(callable $p): self
- take(int $n): self
- takeWhile(callable $p): self
- map(callable $f, string $builtinValidatorName = '', callable $validator = null): self
- flatMap(callable $f, string $builtinValidatorName = '', callable $validator = null): self
- flatten(): self
- collect(callable $p, callable $f): self
- splitAt(int $n): self
- slice(int $from, int $untile): self
- partition(callable $p): self
- span(callable $p): self
- groupBy(callable $f) :self
- unzip(): self
- find(callable $p)
- exists(callable $p): bool
- forall(callable $p): bool
- count(callable $p = null): int
- size(): int
- length(): int
- min(): int
- minFloat(): float
- max(): int
- maxFloat(): float
- mkString(string $string1, string $string2 = '', string $string3 = ''): string
- dropRight($n): self
- sameElements(self $that): bool
- zip(self $that): self
- zipWithIndex(): self
- apply($key)
- contains($elem): bool
- diff(self $that): self
- startsWith(self $that): bool
- endsWith(self $that): bool
- indexOf($elem): int
- isDefinedAt($key): bool
- indices(): self
- distinct(): self
- reverse(): self
- reverseMap(callable $f, string $builtinValidatorName = '', callable $validator = null)
- sorted(): self
- sortWith(callable $lt): self
- patch(int $from, self $that, int $replaced)
- updated(int $n, $elem): self
- cons($elem): self
- getOrElse($key, $default = null)
- keys(): self
- values(): self

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
