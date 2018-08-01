<?php

class Swift_Bug118Test extends \PHPUnit\Framework\TestCase
{
    private $message;

    public function testCallingGenerateIdChangesTheMessageId()
    {
        $currentId = $this->message->getId();
        $this->message->generateId();
        $newId = $this->message->getId();

        $this->assertNotEquals($currentId, $newId);
    }

    protected function setUp()
    {
        $this->message = new Swift_Message();
    }
}
