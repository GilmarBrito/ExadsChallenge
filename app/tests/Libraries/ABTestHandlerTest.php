<?php

declare(strict_types=1);

namespace ExadsChallengeTest\Libraries;

use Exads\ABTestData;
use Exads\ABTestException;
use ExadsChallenge\Libraries\ABTestHandler;
use ExadsChallengeTest\PHPUnitUtil;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ABTestHandlerTest extends TestCase
{
    public static function designerSplitPercentileExceptionProvider(): array
    {
        return [
            [
                [],
            ],
            [
                [
                    [
                        "designId" => 1,
                        "designName" => "designName1",
                        "splitPercent" => 60
                    ],
                    [
                        "designId" => 2,
                        "designName" => "designName2",
                        "splitPercent" => 50
                    ],
                ],
                100,
            ],
        ];
    }

    public static function designerSplitPercentileProvider(): array
    {
        return [
            [
                [
                    [
                        "designId" => 1,
                        "designName" => "designName1",
                        "splitPercent" => 15
                    ],
                    [
                        "designId" => 2,
                        "designName" => "designName2",
                        "splitPercent" => 45
                    ],
                    [
                        "designId" => 3,
                        "designName" => "designName3",
                        "splitPercent" => 40
                    ],
                ],
                100,
            ],
            [
                [
                    [
                        "designId" => 1,
                        "designName" => "designName1",
                        "splitPercent" => 50
                    ],
                    [
                        "designId" => 2,
                        "designName" => "designName2",
                        "splitPercent" => 50
                    ],
                ],
                100,
            ],
        ];
    }
    public static function designerProvider(): array
    {
        return [
            [
                [
                    "designId" => 1,
                    "designName" => "designName1",
                    "splitPercent" => 15,
                ],
                "designName1",
            ],
            [
                [
                    "designId" => 2,
                    "designName" => "designName2",
                    "splitPercent" => 45,
                ],
                "designName2",
            ],
            [
                [
                    "designId" => 3,
                    "designName" => "designName3",
                    "splitPercent" => 30,
                ],
                "designName3",
            ],

        ];
    }

    public function testSelectDesign(): void
    {
        $getAllDesignsReturn = [
            [
                'designId' => 1,
                'designName' => 'design1',
                'splitPercent' => 25,
            ],
            [
                'designId' => 3,
                'designName' => 'design3',
                'splitPercent' => 35,
            ],
            [
                'designId' => 3,
                'designName' => 'design3',
                'splitPercent' => 40,
            ],
        ];

        $abTestDataMock = $this->getMockBuilder(ABTestData::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();
        $abTestDataMock->expects($this->any())
            ->method('getAllDesigns')
            ->willReturn($getAllDesignsReturn);
        $abTestDataMock->expects($this->any())
            ->method('getPromotionName')
            ->willReturn("Promotion 1");

        $objABTestHandler = new ABTestHandler();
        $objABTestHandler->ABTestProvider = $abTestDataMock;

        $actual = $objABTestHandler->selectDesign();

        $this->assertContains(
            $actual,
            array_column(
                $getAllDesignsReturn,
                'designName'
            )
        );
    }

    public function testSelectDesignException(): void
    {
        $abTestDataMock = $this->getMockBuilder(ABTestData::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();
        $abTestDataMock->expects($this->any())
            ->method('getAllDesigns')
            ->will($this->throwException(new ABTestException('Could not load design data!')));
        $abTestDataMock->expects($this->any())
            ->method('getPromotionName')
            ->willReturn("Promotion 1");

        $objABTestHandler = new ABTestHandler();
        $objABTestHandler->ABTestProvider = $abTestDataMock;

        $messageExpected = 'Error: 0 Message: Could not load design data!';
        $actual = $objABTestHandler->selectDesign();
        $this->assertEquals($messageExpected, $actual);
    }

    #[DataProvider('designerSplitPercentileProvider')]
    public function testSetTotalDesignsSplitPercentile(array $designs, int $totalPercentile): void
    {
        $objABTestHandler = new ABTestHandler(3);

        $method = 'setTotalSplitPercentile';
        $property = 'totalSplitPercentile';
        $args = [$designs];
        PHPUnitUtil::callMethod($objABTestHandler, $method, $args);
        $totalSplitPercentile = PHPUnitUtil::getProperty($objABTestHandler, $property);

        $this->assertEquals($totalSplitPercentile, $totalPercentile);
    }

    #[DataProvider('designerSplitPercentileExceptionProvider')]
    public function testSetTotalDesignsSplitPercentileException(): void
    {
        $objABTestHandler = new ABTestHandler(3);

        $this->expectException(Exception::class);

        $method = 'setTotalSplitPercentile';

        $args = [[]];
        PHPUnitUtil::callMethod($objABTestHandler, $method, $args);
    }

    #[DataProvider('designerProvider')]
    public function testGetDesignName(array $inputDesign, string $expected)
    {
        $objABTestHandler = new ABTestHandler(3);

        $method = 'getDesignName';
        $args = [$inputDesign];
        $actualGetDesignName = PHPUnitUtil::callMethod($objABTestHandler, $method, $args);

        $this->assertEquals($expected, $actualGetDesignName);
    }

    public function testGetDesignNameException(): void
    {
        $objABTestHandler = new ABTestHandler(3);

        $this->expectException(Exception::class);
        $method = 'getDesignName';
        $args = [[]];
        PHPUnitUtil::callMethod($objABTestHandler, $method, $args);
    }

    public function testGetPromotionName(): void
    {
        $objABTestHandler = new ABTestHandler(3);

        $method = 'promotionName';
        $args = [[]];
        $promotionName = PHPUnitUtil::getProperty($objABTestHandler, $method, $args);

        $expected = $objABTestHandler->getPromotionName();

        $this->assertEquals($expected, $promotionName);
    }
}
