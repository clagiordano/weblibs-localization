<?php

namespace clagiordano\weblibs\localization;

/**
 * Class StringReader
 * @package clagiordano\weblibs\localization
 */
class StringReader implements Reader
{
    private $stringData = "";
    private $stringPosition = 0;
    private $stringLength = 0;

    /**
     * StringReader constructor.
     *
     * @param $stringData
     */
    public function __construct($stringData = "")
    {
        $this->stringData = $stringData;
        $this->stringLength = strlen($stringData);

        return $this;
    }

    /**
     * @param $bytes
     * @return mixed
     */
    public function read($bytes = null)
    {
        if (is_null($bytes)) {
            $bytes = ($this->stringLength - $this->stringPosition);
        }

        $data = substr($this->stringData, $this->stringPosition, $bytes);
        $this->stringPosition += $bytes;

        if (strlen($this->stringPosition) < $this->stringPosition) {
            $this->stringPosition = strlen($this->stringData);
        }

        return $data;
    }

    /**
     * @param $position
     * @return mixed
     */
    public function seekTo($position)
    {
        $this->stringPosition = $position;

        if (strlen($this->stringData) < $this->stringPosition) {
            $this->stringPosition = strlen($this->stringData);
        }

        return $this->stringPosition;
    }

    /**
     * @return mixed
     */
    public function currentPos()
    {
        return $this->stringPosition;
    }

    /**
     * @return mixed
     */
    public function length()
    {
        return $this->stringLength;
    }
}