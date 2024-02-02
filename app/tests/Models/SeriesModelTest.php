<?php

namespace ExadsChallengeTest\Models;

use ExadsChallenge\Models\SeriesModel;
use PDO;
use PHPUnit\Framework\TestCase;

class SeriesModelTest extends TestCase
{
    public function testFindAllSeriesName()
    {
        $seriesModel = new SeriesModel();

        $seriesData = $seriesModel->findAllSeriesName();

        $this->assertIsArray($seriesData);
        $this->assertCount(5, $seriesData);


        $this->assertArrayHasKey('id', $seriesData[0]);
        $this->assertArrayHasKey('title', $seriesData[0]);
    }

    public function testFindAllByFilters(): void
    {
        $seriesModel = new SeriesModel();

        $seriesData = $seriesModel->findAllByFilters("2024-01-29T15:43");

        $this->assertIsArray($seriesData);
        $this->assertCount(3, $seriesData);




        $this->assertArrayHasKey('id', $seriesData[0]);
        $this->assertArrayHasKey('title', $seriesData[0]);
        $this->assertArrayHasKey('channel', $seriesData[0]);
        $this->assertArrayHasKey('week_day', $seriesData[0]);
        $this->assertArrayHasKey('show_time', $seriesData[0]);
    }
}
