<?php

namespace Websyspro\Commons;

class File
{
  public static function exist(
    string $file
  ): bool {
    return file_exists( $file);
  }

  public static function get(
    string $file
  ): string {
    return file_get_contents( $file);
  }
}