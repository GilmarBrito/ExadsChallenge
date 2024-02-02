<?php

namespace ExadsChallenge\Controllers;

use DateTime;
use ExadsChallenge\Controllers\BaseController;
use ExadsChallenge\Models\SeriesModel;

class SeriesController extends BaseController
{
    public function index()
    {
        $this->model(new SeriesModel());

        $weekDays = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
        ];

        $seriesName = $this->model->findAllSeriesName();
        $dateTime = date(SeriesModel::DATE_TIME_FORMAT);
        $id = 0;

        if ($this->getRequestMethod() === self::HTTP_METHOD_POST) {
            $dateTime = filter_input(INPUT_POST, 'date_time');
            $dateTime = date(SeriesModel::DATE_TIME_FORMAT, strtotime($dateTime));
            $id = (int) filter_input(INPUT_POST, 'series');
        }

        $tvSeries = $this->model->findAllByFilters($dateTime, $id);

        $data = [
            'tv_series' => $tvSeries,
            'series_name' => $seriesName,
            'week_days' => $weekDays,
            'datetime' => $dateTime,
            'series_value' => $id,
        ];

        self::loadView($data);
    }
}
