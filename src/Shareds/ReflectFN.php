<?php

namespace Websyspro\Commons\Shareds;

use Websyspro\Commons\Collection;

/**
 * ReflectFN - Represents reflection information for a function
 * 
 * This class stores file location and line range information for a function,
 * providing methods to extract the actual source code from the file.
 * Used in conjunction with PHP's ReflectionFunction to get code content.
 */
class ReflectFN
{
  /**
   * Creates a ReflectFN instance with function location information
   * 
   * @param string $filename Path to the file containing the function
   * @param int $start Starting line number of the function
   * @param int $end Ending line number of the function
   */
  public function __construct(
    public string $filename,
    public int $start,
    public int $end
  ){}

  /**
   * Extracts the source code lines for the function
   * 
   * Reads the file and returns only the lines that contain the function code
   * based on the start and end line numbers from reflection.
   * 
   * @return Collection Collection containing the function's source code lines
   */
  public function code(
  ): Collection {
    /* Read all lines from the file into a collection */
    $content = new Collection(
      file( $this->filename )
    );

    /* Extract only the lines containing the function code */
    /* Subtract 1 from start because file() uses 0-based indexing */
    return $content->slice(
      $this->start - 1, 
      $this->end - $this->start + 1
    );
  }
}