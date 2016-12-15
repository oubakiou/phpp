# phpp

phpp is basic class library in PHP

[![Build Status](https://travis-ci.org/oubakiou/phpp.svg?branch=master)](https://travis-ci.org/oubakiou/phpp)

## Arr

### basic usage

https://github.com/oubakiou/phpp/blob/master/tests/ArrTest.php#L287

### benchmark

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

https://github.com/oubakiou/phpp/blob/master/tests/ArrBenchTest.php#L18
