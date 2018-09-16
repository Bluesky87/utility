<?php

class ChooseReport
{
    private $reportType;

    private $data;

    public function __construct(ReportTypeInterface $reportType, array $data)
    {
        $this->reportType = $reportType;
        $this->data = $data;
    }

    public function createReport()
    {
        return $this->reportType->generateReport($this->data);
    }

    public function getReport()
    {
        return $this->reportType->saveToFile();
    }

}