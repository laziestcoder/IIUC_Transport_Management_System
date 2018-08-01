<?php

/**
 * @todo
 */
class Swift_Signers_OpenDKIMSignerTest extends \SwiftMailerTestCase
{
    public function testBasicSigningHeaderManipulation()
    {
    }

    public function testSigningDefaults()
    {
    }

    // Default Signing

    public function testSigning256()
    {
    }

    // SHA256 Signing

    public function testSigningRelaxedRelaxed256()
    {
    }

    // Relaxed/Relaxed Hash Signing

    public function testSigningRelaxedSimple256()
    {
    }

    // Relaxed/Simple Hash Signing

    public function testSigningSimpleRelaxed256()
    {
    }

    // Simple/Relaxed Hash Signing

    protected function setUp()
    {
        if (!extension_loaded('opendkim')) {
            $this->markTestSkipped(
                'Need OpenDKIM extension run these tests.'
            );
        }
    }
}
