<?php

interface ReportTypeInterface
{
    public function generateReport(array $data);

    public function saveToFile();
}