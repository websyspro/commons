<?php

namespace Websyspro\Commons;

/**
 * File utility class for common file operations
 * Provides static methods for file existence checking, content reading, and modification time retrieval
 */
class File
{
  /**
   * Get the full path from root directory
   * @param string $filename The filename to append to root path
   * @return string The complete file path from root directory
   */
  public static function rootPath(
    string $filename
  ): string {
    /* Combine current working directory with filename using directory separator */
    return implode( 
      DIRECTORY_SEPARATOR,
      [ getcwd(), $filename ]
    ); 
  }

  /**
   * Check if a file exists
   * @param string $file The file path to check
   * @return bool True if file exists, false otherwise
   */
  public static function exist(
    string $file
  ): bool {
    /* Check if the specified file exists in the filesystem */
    return file_exists( $file);
  }

  /**
   * Get the contents of a file
   * @param string $file The file path to read
   * @return string The file contents as a string
   */
  public static function get(
    string $file
  ): string {
    /* Read and return the entire contents of the file */
    return file_get_contents( $file);
  }

  /**
   * Get the last modification time of a file
   * @param string $filname The file path to check
   * @return string|float The modification time as Unix timestamp
   */
  public static function timestamp(
    string $filname
  ): string|float {
    /* Return the last modification time of the file as Unix timestamp */
    return filemtime( $filname);
  }
}