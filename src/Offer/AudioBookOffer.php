<?php

namespace LireinCore\YMLParser\Offer;

class AudioBookOffer extends ABookOffer
{
    /**
     * @var string
     */
    protected $performedBy;

    /**
     * @var string
     */
    protected $performanceType;
    
    /**
     * @var string
     */
    protected $storage;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $recordingLength;

    /**
     * @return array
     */
    public function getFiledsList()
    {
        return array_merge(parent::getFiledsList(), [
            'performed_by', 'performance_type', 'storage', 'format', 'recording_length'
        ]);
    }

    /**
     * @return string
     */
    public function getPerformedBy()
    {
        return $this->performedBy;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPerformedBy($value)
    {
        $this->performedBy = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getPerformanceType()
    {
        return $this->performanceType;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPerformanceType($value)
    {
        $this->performanceType = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setStorage($value)
    {
        $this->storage = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFormat($value)
    {
        $this->format = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordingLength()
    {
        return $this->recordingLength;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRecordingLength($value)
    {
        $this->recordingLength = (string)$value;

        return $this;
    }
}