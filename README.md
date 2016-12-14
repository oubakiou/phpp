# phpp

phpp is basic class library in PHP

## Arr

### basic usage

https://github.com/oubakiou/phpp/blob/master/tests/ArrTest.php#L287

### benchmark

```
ouba-no-MacBook-Air:phpp ouba$ php -d zend.assertions=0 `which vendor/bin/phpunit` tests/ArrBenchTest.php 
PHPUnit 5.7.3 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.1.0
Configuration: /Users/ouba/Desktop/phpp/phpunit.xml

.                                                                   1 / 1 (100%)

bench start

plain          0001 : 31 ms (usage 4MB)
array_function 0002 : 139 ms (usage 4MB)
Arr            0003 : 131 ms (usage 4MB)

bench end



Time: 615 ms, Memory: 4.00MB

OK (1 test, 2 assertions)
```

https://github.com/oubakiou/phpp/blob/master/tests/ArrBenchTest.php#L18