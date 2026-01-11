<?php

namespace Websyspro\Commons\Shareds;

use Websyspro\Commons\Collection;

class ReflectFN
{
  public function __construct(
    public string $filename,
    public int $start,
    public int $end
  ){}

  public function code(
  ): Collection {
    $content = new Collection(
      file( $this->filename )
    );

    return $content->slice(
      $this->start - 1, 
      $this->end - $this->start + 1
    );
  }
}