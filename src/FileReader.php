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
     * @param $bytes
     * @return mixed
     */
    public function read($bytes)
    {
        $data = "";

        if ($bytes) {
            fseek($this->fileHandle, $this->position);

            // PHP 5.1.1 does not read more than 8192 bytes in one fread()
            // the discussions at PHP Bugs suggest it's the intended behaviour
            while ($bytes > 0) {
                $chunk = fread($this->fileHandle, $bytes);
                $data .= $chunk;
                $bytes -= strlen($chunk);
            }
            $this->position = ftell($this->fileHandle);
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
        $this->position = ftell($this->fileHandle);

        return $this->position;
    }

    /**
     * @return mixed
     */
    public function currentPos()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function length()
    {
        return $this->length;
    }

    /**
     * @return boolean
     */
    private function close()
    {
        return fclose($this->fileHandle);
    }
}