<?php

namespace clagiordano\weblibs\localization;

/**
 * Interface Reader
 * @package clagiordano\weblibs\localization
 */
interface Reader
{
    public function read();

    public function seekTo();

    public function currentPos();

    public function length();
}