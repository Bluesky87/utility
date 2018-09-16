<?php


class XmlReport implements ReportTypeInterface
{
    private $xmlData;

    public function generateReport(array $data)
    {
        $xml = new SimpleXMLElement('<report/>');
        array_walk_recursive($data, array ($xml, 'addChild'));

        $this->xmlData = $xml->asXML();
    }

    public function saveToFile()
    {
        if($this->xmlData) {
            header('Content-disposition: attachment; filename=xmlReport.xml');
            header ("Content-Type:text/xml");

            echo $this->xmlData;
            exit;
        }
        return null;

    }

}