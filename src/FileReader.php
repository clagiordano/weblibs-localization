<?php

namespace clagiordano\weblibs\localization;

/**
 * Class FileReader
 * @package clagiordano\weblibs\localization
 */
class FileReader implements Reader
{
    private $position;
    private $fileHandle;
    private $length;
    private $error;

    /**
     * FileReader constructor.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $this->length = filesize($filename);
            $this->position = 0;
            $this->fileHandle = fopen($filename, 'rb');

            if (!$this->fileHandle) {
                $this->error = 3; // Cannot read file, probably permissions
                return false;
            }
        } else {
            $this->error = 2; // File doesn't exist
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function read()
    {
        // TODO: Implement read() method.
    }

    /**
     * @return mixed
     */
    public function seekTo()
    {
        // TODO: Implement seekTo() method.
    }

    /**
     * @return mixed
     */
    public function currentPos()
    {
        // TODO: Implement currentPos() method.
    }

    /**
     * @return mixed
     */
    public function length()
    {
        // TODO: Implement length() method.
    }

}