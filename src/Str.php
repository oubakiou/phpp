<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: ouba
 * Date: 2016/12/03
 * Time: 20:31.
 */

namespace oubakiou\phpp;

class Str
{
    use ScalaLikeStringMethods;

    private $string;
    private $length;

    public function __construct(string $string)
    {
        $this->string = $string;
        $this->length = strlen($string);

        return $this;
    }

    public function equals(self $str): bool
    {
        return $this->toString() == $str->toString();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->string;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public static function todo()
    {
        throw new \Exception('https://github.com/oubakiou/phpp/compare');
    }
}

trait PhpLikeStringMethods
{
    public function crypt()
    {
        $this->todo();
    }

    public function explode()
    {
        $this->todo();
    }

    public function htmlEntityDecode()
    {
        $this->todo();
    }

    public function htmlEntities()
    {
        $this->todo();
    }

    public function htmlSpecialChars()
    {
        $this->todo();
    }

    public function htmlSpecialCharsDecode()
    {
        $this->todo();
    }

    public function lcfirst()
    {
        $this->todo();
    }

    public function ltrim()
    {
        $this->todo();
    }

    public function md5()
    {
        $this->todo();
    }

    public function moneryFormat()
    {
        $this->todo();
    }

    public function nl2br()
    {
        $this->todo();
    }

    public function numberFormat()
    {
        $this->todo();
    }

    public function print()
    {
        $this->todo();
    }

    public function printf()
    {
        $this->todo();
    }

    public function quoteMeta()
    {
        $this->todo();
    }

    public function rtrim()
    {
        $this->todo();
    }

    public function sha1()
    {
        $this->todo();
    }

    public function sprintf()
    {
        $this->todo();
    }
}

trait ScalaLikeStringMethods
{
    abstract public function getLength(): int;

    public function length(): int
    {
        return $this->getLength();
    }

    public function size(): int
    {
        return $this->getLength();
    }

    public function startsWith(self $str)
    {
        $this->todo();
    }

    public function endsWith(self $str)
    {
        $this->todo();
    }

    public function isEmpty(): bool
    {
        return (bool) $this->length();
    }

    public function nonEmpty(): bool
    {
        return !(bool) $this->length();
    }

    public function indexOf()
    {
        $this->todo();
    }

    public function lastIdexOf()
    {
        $this->todo();
    }

    public function indexOfSlice()
    {
        $this->todo();
    }

    public function lastIndexOfSlice()
    {
        $this->todo();
    }

    public function contains()
    {
        $this->todo();
    }

    public function containsSlice()
    {
        $this->todo();
    }

    public function format()
    {
        $this->todo();
    }

    public function union()
    {
        $this->todo();
    }

    public function addString()
    {
        $this->todo();
    }

    public function padTo()
    {
        $this->todo();
    }

    public function subString()
    {
        $this->todo();
    }

    public function slice()
    {
        $this->todo();
    }

    public function take()
    {
        $this->todo();
    }

    public function takeRight()
    {
        $this->todo();
    }

    public function drop()
    {
        $this->todo();
    }

    public function dropRight()
    {
        $this->todo();
    }

    public function head()
    {
        $this->todo();
    }

    public function last()
    {
        $this->todo();
    }

    public function init()
    {
        $this->todo();
    }

    public function tail()
    {
        $this->todo();
    }

    public function charAt()
    {
        $this->todo();
    }

    public function trim()
    {
        $this->todo();
    }

    public function stripLineEnd()
    {
        $this->todo();
    }

    public function diff()
    {
        $this->todo();
    }

    public function replace()
    {
        $this->todo();
    }

    public function replaceFirst()
    {
        $this->todo();
    }

    public function replaceAll()
    {
        $this->todo();
    }

    public function patch()
    {
        $this->todo();
    }

    public function updated()
    {
        $this->todo();
    }

    public function reverse()
    {
        $this->todo();
    }

    public function split()
    {
        $this->todo();
    }

    public function splitAt()
    {
        $this->todo();
    }

    public function iterator()
    {
        $this->todo();
    }
}
