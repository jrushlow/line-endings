<?php

namespace Jrushlow\LineEndings\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class YamlTest extends TestCase
{
    public function testYamlFile(): void
    {
        $yaml = [
            'security' => [
                'firewalls' => [
                    'main' => [
                        'custom_authenticator' => 'App\Security\SomeOtherAuthenticator',
                    ],
                ],
            ],
        ];

        $newContents = Yaml::dump($yaml, 100);

        self::assertSame($this->getYaml(), $newContents);
    }

    public function testWindowsYamlFile(): void
    {
        $yaml = [
            'security' => [
                'firewalls' => [
                    'main' => [
                        'custom_authenticator' => 'App\Security\SomeOtherAuthenticator',
                    ],
                ],
            ],
        ];

        $newContents = Yaml::dump($yaml, 100);

        self::assertSame($this->getWindowsYaml(), $newContents);
    }

    private function getYaml(): string
    {
        return <<< 'EOT'
security:
    firewalls:
        main:
            custom_authenticator: App\Security\SomeOtherAuthenticator

EOT;

    }

    private function getWindowsYaml(): string
    {
        return <<< EOT
security:
    firewalls:
        main:
            custom_authenticator: App\Security\SomeOtherAuthenticator
\r\n
EOT;
    }
}
