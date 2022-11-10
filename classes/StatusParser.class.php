<?php

class StatusParser extends AbstractParser
{

    private $names = [];
    private $lastUpdate = '';

    public function __construct(string $filePath, array $names)
    {
        $this->names = $names;

        parent::__construct($filePath);
    }

    protected function getUserName(string $commonName)
    {

        if (empty($this->names[$commonName])) {
            return '-';
        }
        return $this->names[$commonName];
    }

    protected function getData()
    {

        $rows = preg_split('/\r\n|\r|\n/', $this->fileContent);

        $clientList = [];
        $routingTable = [];

        foreach ($rows as $row) {

            if (trim($row) === '') continue;

            $columns = explode(',', $row);

            if ($columns[0] === 'CLIENT_LIST') {

                array_shift($columns);
                $clientList[array_shift($columns)] = $columns;

            } else if ($columns[0] === 'ROUTING_TABLE') {
                
                array_shift($columns);
                $routingTable[array_shift($columns)] = $columns;

            } else if ($columns[0] === 'TIME') {
                $this->lastUpdate = $columns[1];
            }
        }

        foreach($clientList as $client) {

            array_push($this->data, array_merge($client, $routingTable[$client[1]]));
        }

        return $this->formatData();
    }

    protected function formatData()
    {

        $result = [];

        foreach ($this->data as $row) {

            $commonName = $row[10];
            $sendBytes = FormatBytes::format($row[3]);
            $receivedBytes = FormatBytes::format($row[4]);
            $hostUrl = parse_url($row[0]);
            $realHost = gethostbyaddr($hostUrl['host']);
            $userName = $this->getUserName($commonName);
            $virtualAddress = $row[1];
            $connectedSince = json_encode([
                'robot' => CustomDateTime::formatDateTime($row[5]),
                'en' => CustomDateTime::prettyDateTime($row[5]),
                'cz' => CustomDateTime::prettyDateTimeCZ($row[5]),
            ]);

            $resultRow = [

                'User Name' => $userName,
                'Common Name' => $commonName,
                'Real Host'	 => [[
                    'tooltip' => $row[0],
                ], $realHost],
                'Virtual Address' => $virtualAddress,	
                'Bytes Rec/Sent' => [[
                    'tooltip' => $row[3].' / '.$row[4],
                ] , $sendBytes.' / '.$receivedBytes],	
                'Connected Since' => [[
                    'tooltip' => $row[5],
                    'datetime' => $connectedSince,
                ], 'null'],
            ];

            array_push($result, $resultRow);
       
        }

        usort($result, function ($a, $b) {
            return strcmp($a['Common Name'], $b['Common Name']);
        });

        return [
            'data' => $result,
            'lastUpdate' => [$this->lastUpdate],
        ];
    }

}