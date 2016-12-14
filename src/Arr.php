<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: ouba
 * Date: 2016/12/03
 * Time: 20:13.
 */

namespace oubakiou\phpp;

class Arr implements \IteratorAggregate
{
    use ScalaLikeCollectionMethods;

    private $array;
    private $validator;
    private $count;
    private $head;
    private $last;

    /**
     * Arr constructor.
     *
     * @param array         $array
     * @param string        $builtinValidatorName
     * @param callable|null $validator:           bool
     */
    private function __construct(array $array, string $builtinValidatorName = '', callable $validator = null)
    {
        if (is_null($array)) {
            $array = [];
        }

        $this->count = count($array);
        $this->last = end($array);
        $this->head = reset($array);
        $this->array = $array;

        $validation = function ($builtinValidatorName, $validator) {
            if ($builtinValidatorName) {
                // http://php.net/manual-lookup.php?pattern=is_&scope=quickref
                $builtinValidatorNameToValidator = function ($builtinValidatorName) {
                    return function ($value) use ($builtinValidatorName) {
                        return ('is_'.$builtinValidatorName)($value);
                    };
                };
                $this->validator = $builtinValidatorNameToValidator($builtinValidatorName);
            }

            if ($validator) {
                $this->validator = $validator;
            }

            return $this->validate();
        };

        assert($validation($builtinValidatorName, $validator));

        return $this;
    }

    public static function ofBools(array $array): self
    {
        return new self($array, 'bool');
    }

    public static function ofInts(array $array): self
    {
        return new self($array, 'int');
    }

    public static function ofArrays(array $array): self
    {
        return new self($array, 'array');
    }

    public static function ofStrings(array $array): self
    {
        return new self($array, 'string');
    }

    public static function ofNumerics(array $array): self
    {
        return new self($array, 'numeric');
    }

    public static function ofScalars(array $array): self
    {
        return new self($array, 'scalar');
    }

    public static function ofFloats(array $array): self
    {
        return new self($array, 'float');
    }

    public static function ofCallables(array $array): self
    {
        return new self($array, 'callable');
    }

    public static function ofArrs(array $array): self
    {
        $validator = function ($value) {
            return $value instanceof Arr;
        };

        return new self($array, '', $validator);
    }

    private function validate(): bool
    {
        if (!$this->validator) {
            return true;
        }

        $validationResults = array_map($this->validator, $this->array);
        $reduce = function ($validationResults) {
            return array_reduce(
                $validationResults,
                function ($carry, $item) {
                    return $carry && $item;
                },
                true
            );
        };

        if (!$reduce($validationResults)) {
            $errorElementIndices = array_keys(
                array_filter($validationResults, function ($validationResult) {
                    return !$validationResult;
                })
            );
            $errorElementNames = array_map(function ($errorElementIndex) {
                return (string) ($errorElementIndex.' => '.print_r($this->array[$errorElementIndex], true));
            }, $errorElementIndices);
            throw new \TypeError('Invalid type elements array('.implode($errorElementNames, ', ').')');
        }

        return true;
    }

    public function __get(string $name)
    {
        return $this->array[$name] ?? null;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (substr($name, 0, 2) === 'of') {
            $instanceName = substr($name, 2, -1);
            $validator = function ($value) use ($instanceName) {
                return $value instanceof $instanceName;
            };

            return new self($arguments[0], '', $validator);
        }
        throw new \BadMethodCallException($name.' is undefined method');
    }

    public function toArray(): array
    {
        return $this->array;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return 'Arr('.print_r($this->toArray(), true).')';
    }

    public function equals(self $arr): bool
    {
        return $this->toArray() == $arr->toArray();
    }

    public function getValidator(): ? callable
    {
        return $this->validator;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getHead()
    {
        return $this->head;
    }

    public function getLast()
    {
        return $this->last;
    }

    //region Iterator IteratorAggregate

    public function getIterator() : \Iterator
    {
        return new \ArrayIterator($this->toArray());
    }

    //endregion
}

trait ScalaLikeCollectionMethods
{
    abstract public function toArray(): array;
    abstract public function getValidator(): callable;
    abstract public function getCount(): int;

    //region collection.immutable.Traversable

    public function append(self $that): self
    {
        return new self(array_merge($this->toArray(), $that->toArray()), '', $this->getValidator());
    }

    public function head()
    {
        return $this->head;
    }

    public function tail(): self
    {
        return new self(array_slice($this->toArray(), 1));
    }

    public function init(): self
    {
        return new self(array_slice($this->toArray(), 0, $this->count - 1));
    }

    public function last()
    {
        return $this->last;
    }

    public function foldLeft(callable $op, $z)
    {
        $array = $this->toArray();

        return array_reduce($array, $op, $z);
    }

    public function foldRight(callable $op, $z)
    {
        $array = array_reverse($this->toArray(), true);

        return array_reduce($array, $op, $z);
    }

    public function reduceLeft(callable $op)
    {
        $array = array_slice($this->toArray(), 1);
        $z = $this->getHead();

        return array_reduce($array, $op, $z);
    }

    public function reduceRight(callable $op)
    {
        $array = array_slice(array_reverse($this->toArray()), 1);
        $z = $this->getLast();

        return array_reduce($array, $op, $z);
    }

    public function foreach(callable $op): void
    {
        array_map($op, $this->toArray());
    }

    public function filter(callable $p = null): self
    {
        if (is_null($p)) {
            return $this;
        }

        return new self(array_filter($this->toArray(), $p), '', $this->getValidator());
    }

    public function filterNot(callable $p): self
    {
        return new self(array_filter($this->toArray(), function ($item) use ($p) {
            return !$p($item);
        }));
    }

    public function drop(int $n): self
    {
        return new self(array_slice($this->toArray(), $n), '', $this->getValidator()->bindTo(null));
    }

    public function dropWhile(callable $p): self
    {
        $i = 0;
        foreach ($this->toArray() as $v) {
            if (!$p($v)) {
                break;
            }
            ++$i;
        }

        return $this->drop($i);
    }

    public function take(int $n): self
    {
        return new self(array_slice($this->toArray(), 0, $n), '', $this->getValidator()->bindTo(null));
    }

    public function takeWhile(callable $p): self
    {
        $i = 0;
        foreach ($this->toArray() as $v) {
            if (!$p($v)) {
                break;
            }
            ++$i;
        }

        return $this->take($i);
    }

    public function map(callable $f, string $builtinValidatorName = '', callable $validator = null): self
    {
        return new self(array_map($f, $this->toArray()), $builtinValidatorName, $validator);
    }

    public function flatMap(callable $f, string $builtinValidatorName = '', callable $validator = null): self
    {
        return $this->flatten()
                    ->map($f);
    }

    public function flatten(): self
    {
        $flatArray = [];
        if (is_array($this->head())) {
            $array = $this->toArray();
            array_walk_recursive($array, function ($elm) use (&$flatArray) {
                $flatArray[] = $elm;
            });
        } elseif ($this->head() instanceof Arr) {
            $flatArray = $this->map(function ($v) {
                return $v->toArray();
            })->flatten()->toArray();
        }

        return new self($flatArray);
    }

    public function collect(callable $p, callable $f): self
    {
        return $this->filter($p)->map($f);
    }

    public function splitAt(int $n): self
    {
        return new self([$this->take($n), $this->drop($n)], '', function ($v) {
            return $v instanceof Arr;
        });
    }

    public function slice(int $from, int $untile): self
    {
        $length = $untile - $from;

        return new self(array_slice($this->toArray(), $from, $length), '', $this->getValidator()->bindTo(null));
    }

    public function partition(callable $p): self
    {
        return new self([$this->filter($p), $this->filterNot($p)], '', function ($v) {
            return $v instanceof Arr;
        });
    }

    public function span(callable $p): self
    {
        $i = 0;
        foreach ($this->toArray() as $v) {
            if (!$p($v)) {
                break;
            }
            ++$i;
        }

        return $this->splitAt($i);
    }

    public function groupBy(callable $f) :self
    {
        $newArray = [];
        foreach ($this->toArray() as $v) {
            $newArray[$f($v)][] = $v;
        }
        foreach ($newArray as $k => $v) {
            $newArray[$k] = new self($v);
        }

        return new self($newArray);
    }

    public function unzip(): self
    {
        return new self([$this->keys(), $this->values()], '', function ($v) {
            return $v instanceof Arr;
        });
    }

    public function find(callable $p)
    {
        foreach ($this->toArray() as $v) {
            if ($p($v)) {
                return $v;
            }
        }

        return null;
    }

    public function exists(callable $p): bool
    {
        return $this->map($p)
                    ->reduceLeft(function ($carry, $item) {
                        return $carry || $item;
                    });
    }

    public function forall(callable $p): bool
    {
        return $this->map($p)
                    ->reduceLeft(function ($carry, $item) {
                        return $carry && $item;
                    });
    }

    public function count(callable $p = null): int
    {
        return $this->filter($p)->size();
    }

    public function size(): int
    {
        return $this->count;
    }

    public function length(): int
    {
        return $this->count;
    }

    public function min(): int
    {
        return min($this->toArray());
    }

    public function minFloat(): float
    {
        return min($this->toArray());
    }

    public function max(): int
    {
        return max($this->toArray());
    }

    public function maxFloat(): float
    {
        return max($this->toArray());
    }

    public function mkString(string $string1, string $string2 = '', string $string3 = ''): string
    {
        if (strlen($string2.$string3) === 0) {
            return implode($this->toArray(), $string1);
        }

        return $string1.implode($this->toArray(), $string2).$string3;
    }

    //endregion

    //region collection.immutable.Iteratable

    public function dropRight($n): self
    {
        return $this->slice(0, $this->length() - $n);
    }

    public function sameElements(self $that): bool
    {
        $thisArray = $this->toArray();
        $thatArray = $that->toArray();
        foreach ($thisArray as $thisValue) {
            $thatValue = array_shift($thatArray);
            if ($thisValue !== $thatValue) {
                return false;
            }
        }
        if (count($thatArray)) {
            return false;
        }

        return true;
    }

    public function zip(self $that): self
    {
        $thisArray = $this->toArray();
        $thatArray = $that->toArray();
        $newArray = [];
        foreach ($thisArray as $thisValue) {
            $thatValue = array_shift($thatArray);
            $newArray[] = new self([$thisValue, $thatValue]);
        }

        return new self($newArray, '', function ($v) {
            return $v instanceof Arr;
        });
    }

    public function zipWithIndex(): self
    {
        $thisArray = $this->toArray();
        $newArray = [];
        foreach ($thisArray as $thisIndex => $thisValue) {
            $newArray[] = new self([$thisValue, $thisIndex]);
        }

        return new self($newArray, '', function ($v) {
            return $v instanceof Arr;
        });
    }

    public function apply($key)
    {
        return $this->$key;
    }

    public function contains($elem): bool
    {
        foreach ($this->toArray() as $v) {
            if ($v === $elem) {
                return true;
            }
        }

        return false;
    }

    public function diff(self $that): self
    {
        return $this->filter(function ($item) use ($that) {
            return !$that->contains($item);
        });
    }

    public function startsWith(self $that): bool
    {
        return $this->take($that->size())
                    ->sameElements($that);
    }

    public function endsWith(self $that): bool
    {
        return $this->reverse()
                    ->startsWith($that->reverse());
    }

    public function indexOf($elem): int
    {
        foreach ($this->toArray() as $k => $v) {
            if ($elem === $v) {
                return $k;
            }
        }

        return -1;
    }

    public function isDefinedAt($key): bool
    {
        return isset($this->toArray()[$key]);
    }

    public function indices(): self
    {
        return new self(array_keys($this->array));
    }

    public function distinct(): self
    {
        return new self(array_unique($this->toArray()), '', $this->getValidator()->bindTo(null));
    }

    public function reverse(): self
    {
        return new self(array_reverse($this->toArray()), '', $this->getValidator()->bindTo(null));
    }

    public function reverseMap(callable $f, string $builtinValidatorName = '', callable $validator = null)
    {
        return $this->reverse()
                    ->map($f, $builtinValidatorName, $validator);
    }

    public function sorted(): self
    {
        $array = $this->toArray();
        sort($array);

        return new self($array, '', $this->getValidator()->bindTo(null));
    }

    public function sortWith(callable $lt): self
    {
        $array = $this->toArray();
        usort($array, $lt);

        return new self($array, '', $this->getValidator()->bindTo(null));
    }

    public function patch(int $from, self $that, int $replaced)
    {
        $tmpArray = $this->toArray();
        $isFirstReplace = true;
        for ($i = $from; $i < $from + $replaced; ++$i) {
            if ($isFirstReplace) {
                $tmpArray[$i] = $that;
                $isFirstReplace = false;
            } else {
                unset($tmpArray[$i]);
            }
        }

        $newArray = [];
        foreach ($tmpArray as $v) {
            if ($v instanceof Arr) {
                foreach ($v as $iv) {
                    $newArray[] = $iv;
                }
            } else {
                $newArray[] = $v;
            }
        }

        return new self($newArray, '', $this->getValidator()->bindTo(null));
    }

    public function updated(int $n, $elem): self
    {
        $newArray = $this->toArray();
        $newArray[$n] = $elem;

        return new self($newArray, '', $this->getValidator()->bindTo(null));
    }

    //endregion

    //region collection.immutable.List

    public function cons($elem): self
    {
        $array = $this->toArray();
        array_unshift($array, $elem);

        return new self($array, '', $this->getValidator()->bindTo(null));
    }

    //endregion

    //region collection.immutable.Map

    public function getOrElse($key, $default = null)
    {
        if (isset($this->array[$key])) {
            return $this->array[$key];
        }

        return $default;
    }

    public function keys(): self
    {
        return new self(array_keys($this->array));
    }

    public function values(): self
    {
        return new self(array_values($this->array));
    }

    //endregion
}
