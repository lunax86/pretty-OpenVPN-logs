<?php

class JournalParser extends AbstractParser
{

    protected function getData()
    {

        $rows = preg_split('/\r\n|\r|\n/', $this->fileContent);

        foreach ($rows as $row) {

            if (trim($row) === '') continue;

            $columns = explode(' ', $row);

            array_push($this->data, $columns);

        }

        return $this->formatData();
    }

    protected function formatData()
    {

        $result = [];
        $names = [];
        $resultWithNames = [];

        foreach ($this->data as $row) {

            //$dateTime = CustomDateTime::formatDateTime($row[0] . ' ' . str_replace('-',':',$row[1]));
            $hodor = $row[0] . ' ' . str_replace('-',':',$row[1]);
            $dateTime = json_encode([
                'robot' => CustomDateTime::formatDateTime($hodor),
                'en' => CustomDateTime::prettyDateTime($hodor),
                'cz' => CustomDateTime::prettyDateTimeCZ($hodor),
            ]);

            $event = $row[2];
            $commonName = $row[3];
            if (USE_CUSTOM_NAMES) {
                $userName = empty(USER_NAMES[$commonName]) ? '-' : USER_NAMES[$commonName];
            } else {
                $userName = $row[4];
            }
            $host = $row[5];

            if (empty($resultWithNames[$commonName])) {
                $resultWithNames[$commonName] = [];
            } else {
                $names[$commonName] = $userName;
            }

            array_push($result, [
                $event,
                $dateTime,
                $userName,
                $host,
                $commonName,
            ]);            

            array_push($resultWithNames[$commonName], [
                $event,
                $dateTime,
            ]);

        }

        return [
            'data' => $result,
            'clients-data' => $resultWithNames,
            'names' => $names,
        ];
    }

}