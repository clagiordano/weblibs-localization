<?php

namespace clagiordano\weblibs\localization;

/**
 * Class FileReader
 * @package clagiordano\weblibs\localization
 */
class FileReader implements Reader
{
    private $filePosition;
    private $fileHandle;
    private $fileLength;
    private $errorCode;

    /**
     * FileReader constructor.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $this->fileLength = filesize($filename);
            $this->filePosition = 0;
            $this->fileHandle = fopen($filename, 'rb');

            if (!$this->fileHandle) {
                $this->errorCode = 3; // Cannot read file, probably permissions
                return false;
            }
        } else {
            $this->errorCode = 2; // File doesn't exist
            return false;
        }
    }

    /**
     * @param $bytes
     * @return mixed
     */
    public function read($bytes)
    {
        $data = "";

        if ($bytes) {
            fseek($this->fileHandle, $this->filePosition);

            // PHP 5.1.1 does not read more than 8192 bytes in one fread()
            // the discussions at PHP Bugs suggest it's the intended behaviour
            while ($bytes > 0) {
                $chunk = fread($this->fileHandle, $bytes);
                $data .= $chunk;
                $bytes -= strlen($chunk);
            }
            $this->filePosition = ftell($this->fileHandle);
        }

        return $data;
    }

    /**
     * @param $position
     * @return mixed
     */
    public function seekTo($position)
    {
        fseek($this->fileHandle, $position);
        $this->filePosition = ftell($this->fileHandle);

        return $this->filePosition;
    }

    /**
     * @return mixed
     */
    public function currentPos()
    {
        return $this->filePosition;
    }

    /**
     * @return mixed
     */
    public function length()
    {
        return $this->fileLength;
    }

    /**
     * @return boolean
     */
    private function close()
    {
        return fclose($this->fileHandle);
    }
}