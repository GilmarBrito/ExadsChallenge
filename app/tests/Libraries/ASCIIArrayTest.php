<?php

declare(strict_types=1);

namespace ExadsChallengeTest\Libraries;

use ExadsChallenge\Libraries\ASCIIArray;
use ExadsChallengeTest\PHPUnitUtil;
use PHPUnit\Framework\TestCase;

class ASCIIArrayTest extends TestCase
{
    public function testGetRandomAsciiByStartEnd(): void
    {
        $defaultStartChar = ",";
        $defaultFinishChar = "|";
        $asciiChars = array_map('chr', range(ord($defaultStartChar), ord($defaultFinishChar)));
        $len = count($asciiChars);
        $objASCIIArray = new ASCIIArray();
        $method = 'getRandomAsciiByStartEnd';
        $args = [$defaultStartChar, $defaultFinishChar];
        $actual = PHPUnitUtil::callMethod($objASCIIArray, $method, $args);

        $this->assertContains($defaultStartChar, $actual);
        $this->assertContains($defaultFinishChar, $actual);
        $this->assertCount($len, $actual);
        $this->assertEqualsCanonicalizing($asciiChars, $actual);
        $this->assertNotEquals($asciiChars, $actual);
    }

    public function testRemoveRandomElement(): void
    {
        $defaultStartChar = ",";
        $defaultFinishChar = "|";
        $asciiChars = array_map('chr', range(ord($defaultStartChar), ord($defaultFinishChar)));
        $len = count($asciiChars);
        $objASCIIArray = new ASCIIArray();
        $method = 'removeRandomElement';
        $args = [$asciiChars];
        $actual = PHPUnitUtil::callMethod($objASCIIArray, $method, $args);

        $this->assertNotCount($len, $actual);
        --$len;
        $this->assertCount($len, $actual);
        $this->assertNotEqualsCanonicalizing($asciiChars, $actual);
    }

    public function testGetMissingCharacter(): void
    {
        $defaultStartChar = ",";
        $defaultFinishChar = "|";

        $objASCIIArray = new ASCIIArray();

        $method = 'getRandomAsciiByStartEnd';
        $args = [$defaultStartChar, $defaultFinishChar];
        $actualGetRandomAsciiByStartEnd = PHPUnitUtil::callMethod($objASCIIArray, $method, $args);

        $method = 'removeRandomElement';
        $args = [$actualGetRandomAsciiByStartEnd];
        $actualRemoveRandomElement = PHPUnitUtil::callMethod($objASCIIArray, $method, $args);

        $method = 'getMissingCharacter';
        $args = [$actualGetRandomAsciiByStartEnd, $actualRemoveRandomElement];
        $expected = implode(
            '',
            array_diff(
                $actualGetRandomAsciiByStartEnd,
                $actualRemoveRandomElement
            )
        );

        $actualRemoveRandomElement = PHPUnitUtil::callMethod($objASCIIArray, $method, $args);

        $this->assertEquals($expected, $actualRemoveRandomElement);
    }
    public function testGetAnswer(): void
    {
        $objASCIIArray = new ASCIIArray();

        $actual = $objASCIIArray->getAnswer();

        $this->assertIsArray($actual);
        $this->assertCount(3, $actual);
    }
}
