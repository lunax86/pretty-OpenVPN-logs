<?php

abstract class AbstractParser
{

    protected $fileContent;
    protected $data = [];
    protected $result = [];

    public function __construct(string $filePath)
    {

        $this->fileContent = file_get_contents($filePath);

        if ($this->fileContent === false) {
            exit('Error occurred while trying to load file content.');
        }

        $this->result = $this->getData();
    }

    public function fetchData($index = null)
    {

        if ($index === null) {
            return $this->result;
        }

        if(empty($this->result[$index])) {
            return [];
        } else {
            return $this->result[$index];
        }

    }

    abstract protected function getData();

    abstract protected function formatData();

}