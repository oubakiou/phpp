<?php
/**
 * Created by PhpStorm.
 * User: ouba
 * Date: 2016/12/10
 * Time: 17:48.
 */

namespace oubakiou\phpp;

class ArrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers            \oubakiou\phpp\Arr::ofBools()
     * @expectedException \TypeError
     */
    public function testOfBoolsArgIsInvalidTypeException()
    {
        Arr::ofBools(1);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofBools()
     * @expectedException \TypeError
     */
    public function testOfBoolsArgIsBoolException()
    {
        Arr::ofBools(true);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofBools()
     * @expectedException \TypeError
     */
    public function testOfBoolsArgIsInvalidTypeElementException()
    {
        Arr::ofBools([0]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofBools()
     * @expectedException \TypeError
     */
    public function testOfBoolsArgIsBoolAndInvalidTypeElementException()
    {
        Arr::ofBools([false, 0, true, 1]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofBools()
     */
    public function testOfBools()
    {
        $this->assertEquals([true], Arr::ofBools([true])->toArray());
        $this->assertEquals([false], Arr::ofBools([false])->toArray());
        $this->assertEquals([true, false], Arr::ofBools([true, false])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofInts()
     * @expectedException \TypeError
     */
    public function testOfIntsArgIsInvalidTypeElementException()
    {
        Arr::ofInts([true]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofInts()
     */
    public function testOfInts()
    {
        $this->assertEquals([1], Arr::ofInts([1])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofArrays()
     * @expectedException \TypeError
     */
    public function testOfArraysArgIsInvalidTypeElementException()
    {
        Arr::ofArrays([true]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofArrays()
     */
    public function testOfArrays()
    {
        $this->assertEquals([[1]], Arr::ofArrays([[1]])->toArray());
        $this->assertEquals([[1, 3, 5], [2, 4, 8]], Arr::ofArrays([[1, 3, 5], [2, 4, 8]])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofStrings()
     * @expectedException \TypeError
     */
    public function testOfStringsArgIsInvalidTypeElementException()
    {
        Arr::ofStrings([true]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofStrings()
     */
    public function testOfStrings()
    {
        $this->assertEquals(['1'], Arr::ofStrings(['1'])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofNumerics()
     * @expectedException \TypeError
     */
    public function testOfNumericsIsInvalidTypeElementException()
    {
        Arr::ofStrings([true]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofNumerics()
     */
    public function testOfNumerics()
    {
        $this->assertEquals(['42'], Arr::ofNumerics(['42'])->toArray());
        $this->assertEquals([1337], Arr::ofNumerics([1337])->toArray());
        $this->assertEquals([0x539], Arr::ofNumerics([0x539])->toArray());
        $this->assertEquals([02471], Arr::ofNumerics([02471])->toArray());
        $this->assertEquals([0b1010011001], Arr::ofNumerics([0b1010011001])->toArray());
        $this->assertEquals([1337e0], Arr::ofNumerics([1337e0])->toArray());
        $this->assertEquals([9.1], Arr::ofNumerics([9.1])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofScalars()
     * @expectedException \TypeError
     */
    public function testOfScalarsArgIsInvalidTypeElementException()
    {
        Arr::ofScalars([[1]]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofScalars()
     */
    public function testOfScalars()
    {
        $this->assertEquals(['42'], Arr::ofScalars(['42'])->toArray());
        $this->assertEquals([1337], Arr::ofScalars([1337])->toArray());
        $this->assertEquals([9.1], Arr::ofScalars([9.1])->toArray());
        $this->assertEquals([true], Arr::ofScalars([9.1])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofFloats()
     * @expectedException \TypeError
     */
    public function testOfFloatsArgIsInvalidTypeElementException()
    {
        Arr::ofFloats([1]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofFloats()
     */
    public function testOfFloats()
    {
        $this->assertEquals([1.0], Arr::ofFloats([1.0])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofCallables()
     * @expectedException \TypeError
     */
    public function testOfCallablesArgIsInvalidTypeElementException()
    {
        Arr::ofCallables([1]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofCallables()
     */
    public function testOfCallables()
    {
        $this->assertEquals([function () {
        }], Arr::ofCallables([function () {
            return true;
        }])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofArrs()
     * @expectedException \TypeError
     */
    public function testOfArrsArgIsInvalidTypeElementException()
    {
        Arr::ofArrs([1]);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::ofArrs()
     */
    public function testOfArrs()
    {
        $this->assertEquals([Arr::ofInts([1])], Arr::ofArrs([Arr::ofInts([1])])->toArray());
    }

    public function testGetter()
    {
        $this->assertEquals(1, Arr::ofInts(['one' => 1, 'two' => 2])->one);
    }

    /**
     * @expectedException \TypeError
     */
    public function testUndefinedTypeCallStaticException()
    {
        Arr::ofSplFileInfos([1]);
    }

    public function testCallStatic()
    {
        $this->assertEquals([new \SplFileInfo('')], Arr::ofSplFileInfos([new \SplFileInfo('')])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::toArray()
     */
    public function testToArray()
    {
        $this->assertEquals([1], Arr::ofInts([1])->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::equals()
     */
    public function testEquals()
    {
        $a = Arr::ofInts([1]);
        $b = Arr::ofInts([1]);
        $this->assertTrue($a->equals($b));

        $c = Arr::ofInts([2]);
        $this->assertFalse($a->equals($c));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getValidator()
     */
    public function testGetValidator()
    {
        $this->assertTrue(is_callable(Arr::ofInts([1])->getValidator()));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getCount()
     */
    public function testGetCount()
    {
        $this->assertEquals(3, Arr::ofInts([1, 2, 3])->getCount());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getHead()
     */
    public function testGetHead()
    {
        $this->assertEquals(1, Arr::ofInts([1, 2, 3])->getHead());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getLast()
     */
    public function testGetLast()
    {
        $this->assertEquals(3, Arr::ofInts([1, 2, 3])->getLast());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getIterator()
     */
    public function testGetIterator()
    {
        $this->assertTrue(Arr::ofInts([1, 2, 3])->getIterator() instanceof \Iterator);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::append()
     */
    public function testAppend()
    {
        $this->assertEquals([1, 2, 3, 4], Arr::ofInts([1, 2, 3])->append(Arr::ofInts([4]))->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::head()
     */
    public function testHead()
    {
        $this->assertEquals(1, Arr::ofInts([1, 2, 3])->head());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::tail()
     */
    public function testTail()
    {
        $this->assertEquals([2, 3], Arr::ofInts([1, 2, 3])->tail()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::init()
     */
    public function testInit()
    {
        $this->assertEquals([1, 2], Arr::ofInts([1, 2, 3])->init()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::last()
     */
    public function testLast()
    {
        $this->assertEquals(3, Arr::ofInts([1, 2, 3])->last());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::foldLeft()
     */
    public function testFoldLeft()
    {
        $op = function ($a, $b) {
            return $a.$b;
        };
        $this->assertEquals('z123', Arr::ofStrings(['1', '2', '3'])->foldLeft($op, 'z'));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::foldRight()
     */
    public function testFoldRight()
    {
        $op = function ($a, $b) {
            return $a.$b;
        };
        $this->assertEquals('z321', Arr::ofStrings(['1', '2', '3'])->foldRight($op, 'z'));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::reduceLeft()
     */
    public function testReduceLeft()
    {
        $op = function ($a, $b) {
            return $a.$b;
        };
        $this->assertEquals('123', Arr::ofStrings(['1', '2', '3'])->reduceLeft($op));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::reduceRight()
     */
    public function testReduceRight()
    {
        $op = function ($a, $b) {
            return $a.$b;
        };
        $this->assertEquals('321', Arr::ofStrings(['1', '2', '3'])->reduceRight($op));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::foreach()
     */
    public function testForeach()
    {
        $actual = 0;
        $op = function ($v) use (&$actual) {
            $actual += $v;
        };
        Arr::ofInts([1, 2, 3])->foreach($op);
        $this->assertEquals(6, $actual);
    }

    /**
     * @covers            \oubakiou\phpp\Arr::filter()
     */
    public function testFilter()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertEquals([0 => 0, 2 => 2], Arr::ofInts([0, 1, 2, 3])->filter($p)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::filterNot()
     */
    public function testFilterNot()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertEquals([1 => 1, 3 => 3], Arr::ofInts([0, 1, 2, 3])->filterNot($p)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::drop()
     */
    public function testDrop()
    {
        $this->assertEquals([2, 3], Arr::ofInts([0, 1, 2, 3])->drop(2)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::dropWhile()
     */
    public function testDropWhile()
    {
        $p = function ($v) {
            return $v <= 2;
        };
        $this->assertEquals([3], Arr::ofInts([0, 1, 2, 3])->dropWhile($p)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::take()
     */
    public function testTake()
    {
        $this->assertEquals([0, 1], Arr::ofInts([0, 1, 2, 3])->take(2)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::takeWhile()
     */
    public function testTakeWhile()
    {
        $p = function ($v) {
            return $v <= 2;
        };
        $this->assertEquals([0, 1, 2], Arr::ofInts([0, 1, 2, 3])->takeWhile($p)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::map()
     */
    public function testMap()
    {
        $f = function ($v) {
            return $v * 2;
        };
        $this->assertEquals([0, 2, 4, 6], Arr::ofInts([0, 1, 2, 3])->map($f)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::flatMap()
     */
    public function testFlatMap()
    {
        $f = function ($v) {
            return $v * 2;
        };
        $this->assertEquals([0, 2, 4, 6], Arr::ofArrays([[0], [1], [2, 3]])->flatMap($f)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::flatten()
     */
    public function testFlatten()
    {
        $this->assertEquals(
            [0, 1, 2, 3],
            Arr::ofArrays([[0], [1], [2, 3]])->flatten()->toArray()
        );

        $this->assertEquals(
            [0, 1, 2, 3],
            Arr::ofArrs([Arr::ofInts([0]), Arr::ofInts([1]), Arr::ofInts([2, 3])])->flatten()->toArray()
        );
    }

    /**
     * @covers            \oubakiou\phpp\Arr::collect()
     */
    public function testCollect()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $f = function ($v) {
            return $v * 2;
        };
        $this->assertEquals([0 => 0, 2 => 4], Arr::ofInts([0, 1, 2, 3])->collect($p, $f)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::splitAt()
     */
    public function testSplitAt()
    {
        $result = Arr::ofInts([1, 2, 3, 4, 5])->splitAt(2);

        $this->assertEquals([1, 2], $result->head()->toArray());
        $this->assertEquals([3, 4, 5], $result->last()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::slice()
     */
    public function testSlice()
    {
        $this->assertEquals([2, 3], Arr::ofInts([1, 2, 3, 4, 5])->slice(1, 3)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::partition()
     */
    public function testPartition()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $result = Arr::ofInts([0, 1, 2, 3])->partition($p);
        $this->assertEquals([0 => 0, 2 => 2], $result->head()->toArray());
        $this->assertEquals([1 => 1, 3 => 3], $result->last()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::span()
     */
    public function testSpan()
    {
        $p = function ($v) {
            return (bool) ($v <= 2);
        };
        $result = Arr::ofInts([0, 1, 2, 3])->span($p);
        $this->assertEquals([0 => 0, 1 => 1, 2 => 2], $result->head()->toArray());
        $this->assertEquals([0 => 3], $result->last()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::groupBy()
     */
    public function testGroupBy()
    {
        $f = function ($v) {
            return strlen($v);
        };
        $result = Arr::ofStrings(['zero', 'one', 'two', 'three'])->groupBy($f);
        $this->assertEquals(['zero'], $result->apply(4)->toArray());
        $this->assertEquals(['one', 'two'], $result->apply(3)->toArray());
        $this->assertEquals(['three'], $result->apply(5)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::unzip()
     */
    public function testUnZip()
    {
        $result = Arr::ofInts(['one' => 1, 'two' => 2])->unzip();

        $this->assertEquals(['one', 'two'], $result->head()->toArray());
        $this->assertEquals([1, 2], $result->last()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::find()
     */
    public function testFind()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertEquals(4, Arr::ofInts([1, 4, 3, 2])->find($p));
        $this->assertEquals(null, Arr::ofInts([1, 3, 5])->find($p));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::exists()
     */
    public function testExists()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertTrue(Arr::ofInts([1, 2, 3, 4])->exists($p));
        $this->assertFalse(Arr::ofInts([1, 3, 5, 7])->exists($p));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::forall()
     */
    public function testForAll()
    {
        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertTrue(Arr::ofInts([2, 4, 6, 8])->forall($p));
        $this->assertFalse(Arr::ofInts([2, 4, 6, 9])->forall($p));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::count()
     */
    public function testCount()
    {
        $this->assertEquals(4, Arr::ofInts([1, 2, 3, 4])->count());

        $p = function ($v) {
            return (bool) ($v % 2 == 0);
        };
        $this->assertEquals(2, Arr::ofInts([1, 2, 3, 4])->count($p));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::size()
     */
    public function testSize()
    {
        $this->assertEquals(4, Arr::ofInts([1, 2, 3, 4])->count());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::length()
     */
    public function testLength()
    {
        $this->assertEquals(4, Arr::ofInts([1, 2, 3, 4])->count());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::min()
     */
    public function testMin()
    {
        $this->assertEquals(1, Arr::ofInts([1, 2, 3, 4])->min());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::max()
     */
    public function testMax()
    {
        $this->assertEquals(4, Arr::ofInts([1, 2, 3, 4])->max());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::minFloat()
     */
    public function testMinFloat()
    {
        $this->assertEquals(1.0, Arr::ofFloats([1.0, 2.0, 3.0, 4.0])->minFloat());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::maxFloat()
     */
    public function testMaxFloat()
    {
        $this->assertEquals(4.0, Arr::ofFloats([1.0, 2.0, 3.0, 4.0])->maxFloat());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::mkString()
     */
    public function testMkString()
    {
        $this->assertEquals('1,2,3,4', Arr::ofInts([1, 2, 3, 4])->mkString(','));
        $this->assertEquals('a1,2,3,4b', Arr::ofInts([1, 2, 3, 4])->mkString('a', ',', 'b'));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::dropRight()
     */
    public function testDropRight()
    {
        $this->assertEquals([0, 1, 2], Arr::ofInts([0, 1, 2, 3])->dropRight(1)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::sameElements()
     */
    public function testSameElements()
    {
        $this->assertFalse(Arr::ofInts([1, 2, 3])->sameElements(Arr::ofInts([1, 2])));
        $this->assertTrue(Arr::ofInts([1, 2, 3])->sameElements(Arr::ofInts([1, 2, 3])));
        $this->assertFalse(Arr::ofInts([1, 2, 3])->sameElements(Arr::ofInts([1, 2, 3, 4])));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::zip()
     */
    public function testZip()
    {
        $result = Arr::ofInts([1, 2, 3])->zip(Arr::ofInts([10, 20, 30]));
        $this->assertEquals([1, 10], $result->apply(0)->toArray());
        $this->assertEquals([2, 20], $result->apply(1)->toArray());
        $this->assertEquals([3, 30], $result->apply(2)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::zipWithIndex()
     */
    public function testZipWithIndex()
    {
        $result = Arr::ofInts([10, 20, 30])->zipWithIndex();
        $this->assertEquals([10, 0], $result->apply(0)->toArray());
        $this->assertEquals([20, 1], $result->apply(1)->toArray());
        $this->assertEquals([30, 2], $result->apply(2)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::apply()
     */
    public function testApply()
    {
        $this->assertEquals(2, Arr::ofInts([0, 1, 2, 3])->apply(2));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::contains()
     */
    public function testContains()
    {
        $this->assertTrue(Arr::ofInts([1, 2, 3, 4])->contains(1));
        $this->assertFalse(Arr::ofInts([1, 2, 3, 4])->contains(5));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::diff()
     */
    public function testDiff()
    {
        $this->assertEquals([0 => 0, 1 => 1, 3 => 3], Arr::ofInts([0, 1, 2, 3])->diff(Arr::ofInts([2, 4]))->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::startsWith()
     */
    public function testStartsWith()
    {
        $this->assertTrue(Arr::ofInts([1, 2, 3, 4])->startsWith(Arr::ofInts([1, 2])));
        $this->assertFalse(Arr::ofInts([1, 2, 3, 4])->startsWith(Arr::ofInts([1, 1])));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::endsWith()
     */
    public function testEndsWith()
    {
        $this->assertTrue(Arr::ofInts([1, 2, 3, 4])->endsWith(Arr::ofInts([3, 4])));
        $this->assertFalse(Arr::ofInts([1, 2, 3, 4])->endsWith(Arr::ofInts([4, 4])));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::indexOf()
     */
    public function testIndexOf()
    {
        $this->assertEquals(3, Arr::ofInts([1, 2, 4, 8])->indexOf(8));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::isDefinedAt()
     */
    public function testIsDefinedAt()
    {
        $this->assertTrue(Arr::ofInts([1, 2, 3])->isDefinedAt(2));
        $this->assertFalse(Arr::ofInts([1, 2, 3])->isDefinedAt(3));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::indices()
     */
    public function testIndices()
    {
        $this->assertEquals([0, 1, 2], Arr::ofInts([1, 2, 3])->indices()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::distinct()
     */
    public function testDistinct()
    {
        $this->assertEquals([0 => 0, 1 => 1, 3 => 2], Arr::ofInts([0, 1, 1, 2])->distinct()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::reverse()
     */
    public function testReverse()
    {
        $this->assertEquals([0 => 0, 1 => 1, 2 => 2], Arr::ofInts([2, 1, 0])->reverse()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::reverseMap()
     */
    public function testReverseMap()
    {
        $f = function ($v) {
            return $v * 2;
        };
        $this->assertEquals([0 => 0, 1 => 2, 2 => 4], Arr::ofInts([2, 1, 0])->reverseMap($f)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::sorted()
     */
    public function testSorted()
    {
        $this->assertEquals([0 => 0, 1 => 1, 2 => 2], Arr::ofInts([2, 1, 0])->sorted()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::sortWith()
     */
    public function testSortWith()
    {
        $lt = function ($a, $b) {
            return $a > $b;
        };
        $this->assertEquals([0 => 0, 1 => 1, 2 => 2], Arr::ofInts([2, 1, 0])->sortWith($lt)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::patch()
     */
    public function testPatch()
    {
        $this->assertEquals([1, 4, 5, 3], Arr::ofInts([1, 2, 3])->patch(1, Arr::ofInts([4, 5]), 1)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::updated()
     */
    public function testUpdated()
    {
        $this->assertEquals([1, 10, 3], Arr::ofInts([1, 2, 3])->updated(1, 10)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::cons()
     */
    public function testCons()
    {
        $this->assertEquals([1, 2, 3], Arr::ofInts([2, 3])->cons(1)->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::getOrElse()
     */
    public function testGetOrElse()
    {
        $this->assertEquals('fuga', Arr::ofStrings(['hoge' => 'fuga', 'foo' => 'bar'])->getOrElse('hoge', 'default'));
        $this->assertEquals('default', Arr::ofStrings(['hoge' => 'fuga', 'foo' => 'bar'])->getOrElse('piyo', 'default'));
    }

    /**
     * @covers            \oubakiou\phpp\Arr::keys()
     */
    public function testKeys()
    {
        $this->assertEquals(['hoge', 'foo'], Arr::ofStrings(['hoge' => 'fuga', 'foo' => 'bar'])->keys()->toArray());
    }

    /**
     * @covers            \oubakiou\phpp\Arr::values()
     */
    public function testValues()
    {
        $this->assertEquals(['fuga', 'bar'], Arr::ofStrings(['hoge' => 'fuga', 'foo' => 'bar'])->values()->toArray());
    }
}
