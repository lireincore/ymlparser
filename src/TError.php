<?php
namespace LireinCore\YMLParser;

trait TError
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return array
     */
    public function getData()
    {
        $data = $this->toArray();
        unset($data['errors']);

        return $data;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $errorMessage
     */
    protected function setError($errorMessage)
    {
        $this->errors[] = $errorMessage;
    }
}