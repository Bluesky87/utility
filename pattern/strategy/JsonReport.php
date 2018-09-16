<?php

class JsonReport implements ReportTypeInterface
{
    private $jsonData;

    public function generateReport(array $data)
    {
        $this->jsonData = json_encode($data);

        return $this->jsonData;
    }

    public function saveToFile()
    {
       if($this->jsonData) {
           header("Content-type: text/plain");
           header("Content-Disposition: attachment; filename=jsonReport.txt");

           print $this->jsonData;
           exit;
       }
       return null;
    }
}