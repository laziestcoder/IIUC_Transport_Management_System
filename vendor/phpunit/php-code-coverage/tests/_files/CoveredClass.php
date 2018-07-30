<?php

class CoveredParentClass
{
    public function publicMethod()
    {
        $this->protectedMethod();
    }

    protected function protectedMethod()
    {
        $this->privateMethod();
    }

    private function privateMethod()
    {
    }
}

class CoveredClass extends CoveredParentClass
{
    public function publicMethod()
    {
        parent::publicMethod();
        $this->protectedMethod();
    }

    protected function protectedMethod()
    {
        parent::protectedMethod();
        $this->privateMethod();
    }

    private function privateMethod()
    {
    }
}
