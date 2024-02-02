<?php

declare(strict_types=1);

namespace ExadsChallengeTest\Libraries;

use ExadsChallenge\Libraries\PrimeNumbers;
use ExadsChallengeTest\PHPUnitUtil;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PrimeNumbersTest extends TestCase
{
    public static function primeProvider(): array
    {
        return [
            [0, false],
            [1, false],
            [2, true],
            [3, true],
            [4, false],
            [5, true],
            [6, false],
            [7, true],
            [8, false],
            [9, false],
            [10, false],
        ];
    }

    public static function multiplesProvider(): array
    {
        return [
            [0, []],
            [1, [1]],
            [2, [1, 2]],
            [3, [1, 3]],
            [4, [1, 2, 4]],
            [5, [1, 5]],
            [6, [1, 2, 3, 6]],
            [7, [1, 7]],
            [8, [1, 2, 4, 8]],
            [9, [1, 3, 9]],
            [10, [1, 2, 5, 10]],
        ];
    }
    public static function answerProvider(): array
    {
        return [
            [
                [
                    "<info>1 [1]</info>",
                    "<info>2 [PRIME]</info>",
                    "<info>3 [PRIME]</info>",
                    "<info>4 [1,2,4]</info>",
                    "<info>5 [PRIME]</info>",
                    "<info>6 [1,2,3,6]</info>",
                    "<info>7 [PRIME]</info>",
                    "<info>8 [1,2,4,8]</info>",
                    "<info>9 [1,3,9]</info>",
                    "<info>10 [1,2,5,10]</info>",
                ]
            ]
        ];
    }

    #[DataProvider('primeProvider')]
    public function testIsPrime(int $number, bool $expected): void
    {
        $objPrimeNumber = new PrimeNumbers();

        $method = 'isPrime';
        $args = [$number];
        $actualIsPrime = PHPUnitUtil::callMethod($objPrimeNumber, $method, $args);

        $this->assertIsBool($actualIsPrime);
        $this->assertEquals($expected, $actualIsPrime);
    }

    #[DataProvider('multiplesProvider')]
    protected function testGetMultiplesOf(int $number, array $expected): void
    {
        $objPrimeNumber = new PrimeNumbers();

        $method = 'getMultiplesOf';
        $args = [$number];
        $actualMultiplesOf = PHPUnitUtil::callMethod($objPrimeNumber, $method, $args);

        $this->assertIsArray($actualMultiplesOf);
        $this->assertEquals($expected, $actualMultiplesOf);
    }

    #[DataProvider('answerProvider')]
    public function testGetAnswer(array $expected): void
    {
        $objPrimeNumber = new PrimeNumbers(1, 10);

        $actualGetAnswer = $objPrimeNumber->getAnswer();

        $this->assertIsArray($actualGetAnswer);
        $this->assertCount(10, $actualGetAnswer);
        $this->assertEquals($expected, $actualGetAnswer);
    }
}
