<?php

namespace Jrushlow\LineEndings\Test;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    private const TMP_PATH = __DIR__.'/tmp';

    protected function setUp(): void
    {
        if (!is_dir(self::TMP_PATH)) {
            mkdir(self::TMP_PATH);
        }
    }

    protected function tearDown(): void
    {
//        rmdir(self::TMP_PATH);
    }

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

    public function testWriteStringToFile(): void
    {
        file_put_contents(self::TMP_PATH.'/test-1.result', $this->getString());

        self::assertSame(
            file_get_contents(__DIR__.'/fixtures/string_line.test'),
            file_get_contents(self::TMP_PATH.'/test-1.result')
        );
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
