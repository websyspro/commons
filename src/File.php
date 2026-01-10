<?php

namespace Websyspro\Commons;

class File
{
  public static function exist(
    string $file
  ): bool {
    return file_exists( $file);
  }
}