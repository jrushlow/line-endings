<?php

namespace Jrushlow\LineEndings\Test;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    public function testTest(): void
    {
        self::assertTrue(true);
    }

    public function testStringEqualsFile(): void
    {
        self::assertEquals($this->getString(), file_get_contents(__DIR__.'/fixtures/string_line.test'));
    }

    public function testStringSameAsFile(): void
    {
        self::assertSame($this->getString(), file_get_contents(__DIR__.'/fixtures/string_line.test'));
    }

    private function getString(): string
    {
        return <<< 'EOT'
security:
    firewalls:
        main:
            custom_authenticator: App\Security\SomeOtherAuthenticator



===
$string = $data['security']['firewalls']['main']['custom_authenticator'];
$data['security']['firewalls']['main']['custom_authenticator'] = [];
$data['security']['firewalls']['main']['custom_authenticator'][] = $string;
$data['security']['firewalls']['main']['custom_authenticator'][] = 'App\Security\AppCustomAuthenticator';
===
security:
    firewalls:
        main:
            custom_authenticator:
                - App\Security\SomeOtherAuthenticator
                - App\Security\AppCustomAuthenticator



EOT;
    }
}
