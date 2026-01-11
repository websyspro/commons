<?php

namespace Websyspro\Commons\Shareds;

use Websyspro\Commons\Enums\TokenType;
use Websyspro\Commons\Util;

class Token
{
  public TokenType|null $type = null;
  public string|null $value = null;
  public int|null $line = null;

  public function __construct(
    string|array $token
  ){
    Util::isArray( $token ) 
      ? $this->parseFromArray( $token ) 
      : $this->parseFromString( $token );
  }

  public function parseFromArray(
    array $token 
  ): void {
    [ $type, $value, $line 
    ] = $token;

    $this->type = TokenType::from( $type );
    $this->value = $value;
    $this->line = $line;
  }

  public function parseFromString(
    string $token 
  ): void {
    $this->value = $token;
  }
}