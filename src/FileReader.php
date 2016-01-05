<?php

namespace clagiordano\weblibs\localization;

/**
 * Class FileReader
 * @package clagiordano\weblibs\localization
 */
class FileReader implements Reader
{
    const ERROR_CANNOT_READ_FILE = 3;
    const ERROR_FILE_NOT_EXISTS = 2;

    private $filePosition;
    private $fileHandle;
    private $fileLength;

    /**
     * FileReader constructor.
     *
     * @param $filename
     * @throws \Exception
     */
    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $this->fileLength = filesize($filename);
            $this->filePosition = 0;
            $this->fileHandle = fopen($filename, 'rb');

            if (!$this->fileHandle) {
                throw new \Exception(__METHOD__
                    . ": Cannot read file '{$filename}', probably permissions.");
            }
        } else {
            throw new \Exception(__METHOD__ . ": File '{$filename}' doesn't exist!");
        }

        return $this;
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