<?php
if ($neverHappens) {
    // @codeCoverageIgnoreStart
    print '*';
    // @codeCoverageIgnoreEnd
}

interface Bor
{
    public function foo();

}

/**
 * @codeCoverageIgnore
 */
class Foo
{
    public function bar()
    {
    }
}

function baz()
{
    print '*'; // @codeCoverageIgnore
}

class Bar
{
    /**
     * @codeCoverageIgnore
     */
    public function foo()
    {
    }
}
