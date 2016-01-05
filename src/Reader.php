<?php

namespace clagiordano\weblibs\localization;

/**
 * Interface Reader
 * @package clagiordano\weblibs\localization
 */
interface Reader
{
    public function read($bytes = null);

    public function seekTo($position);

    public function currentPos();

    public function length();
}