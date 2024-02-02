<?php

namespace ExadsChallenge\Models;

use ExadsChallenge\Models\BaseModel;
use PDO;

class SeriesModel extends BaseModel
{
    public const DATE_TIME_FORMAT = 'Y-m-d\TH:i';
    public const WEEKDAYS = [
        "Sunday" => 0,
        "Monday" => 1,
        "Tuesday" => 2,
        "Wednesday" => 3,
        "Thursday" => 4,
        "Friday" => 5,
        "Saturday" => 6,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'tv_series';
    }

    public function findAllSeriesName(): array
    {
        $result = $this->database->executeQuery(
            "SELECT id, title FROM {$this->tableName};"
        );

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllByFilters(string $dateTime = '', int $id = 0): array
    {
        if ($dateTime === '') {
            $dateTime = date(SeriesModel::DATE_TIME_FORMAT);
        }

        $weekDay = (int) date('N', strtotime($dateTime));

        $time = date('H:i:s', strtotime($dateTime));

        $sql = sprintf(
            "SELECT S.*, SI.week_day, SI.show_time
            FROM %s as S
            INNER JOIN tv_series_intervals as SI ON S.id = SI.tv_series_id
            WHERE SI.week_day = :WEEK_DAY AND SI.show_time >= :TIME %s
            ORDER BY S.title, SI.week_day, SI.show_time ASC;",
            $this->tableName,
            $id !== 0 ? 'AND S.id = :ID' : '',
        );


        $params = [
            ':WEEK_DAY' => $weekDay,
            ':TIME' => $time,
        ];

        if ($id !== 0) {
            $params[':ID'] = $id;
        }

        $result = $this->database->executeQuery(
            $sql,
            $params
        );

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
