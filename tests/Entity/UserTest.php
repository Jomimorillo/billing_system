<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSerializeHashesPassword(): void
    {
        $user = new User();
        $user->setPassword('my_super_secret_password');

        $serialized = $user->__serialize();

        $expectedKey = "\0" . User::class . "\0password";

        $this->assertArrayHasKey($expectedKey, $serialized);
        $this->assertEquals(hash('crc32c', 'my_super_secret_password'), $serialized[$expectedKey]);

        // Ensure the original password is not in the array
        $this->assertNotContains('my_super_secret_password', $serialized);
    }

    public function testSerializeWithNullPassword(): void
    {
        $user = new User();

        // By default password is null
        $serialized = $user->__serialize();

        $expectedKey = "\0" . User::class . "\0password";

        $this->assertArrayHasKey($expectedKey, $serialized);
        $this->assertEquals(hash('crc32c', ''), $serialized[$expectedKey]);
    }
}
