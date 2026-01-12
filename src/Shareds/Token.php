<?php

namespace Websyspro\Commons\Shareds;

use Websyspro\Commons\Enums\TokenType;
use Websyspro\Commons\Util;

/**
 * Token - Represents a PHP token with type, value and line information
 * 
 * This class wraps PHP tokens (from token_get_all) providing a convenient
 * interface to access token properties and perform token comparisons.
 * Supports both array tokens (with type info) and string tokens (symbols).
 */
class Token
{
  /** @var TokenType|null The token type (null for string tokens/symbols) */
  public TokenType|null $type = null;
  
  /** @var string|null The token value/content */
  public string|null $value = null;
  
  /** @var int|null The line number where token appears */
  public int|null $line = null;

  /**
   * Creates a Token instance from PHP token data
   * 
   * @param string|array $token Token data from token_get_all or string symbol
   */
  public function __construct(
    string|array $token
  ){
    /* Parse token based on its type - array for typed tokens, string for symbols */
    Util::isArray( $token ) 
      ? $this->parseFromArray( $token ) 
      : $this->parseFromString( $token );
  }

  /**
   * Parses token data from array format (typed tokens)
   * 
   * @param array $token Array containing [type, value, line]
   * @return void
   */
  public function parseFromArray(
    array $token 
  ): void {
    /* Destructure token array into type, value and line components */
    [ $type, $value, $line 
    ] = $token;

    /* Convert numeric type to TokenType enum and assign properties */
    $this->type = TokenType::from( $type );
    $this->value = $value;
    $this->line = $line;
  }

  /**
   * Parses token data from string format (symbol tokens)
   * 
   * @param string $token String symbol (e.g., '{', '}', ';')
   * @return void
   */
  public function parseFromString(
    string $token 
  ): void {
    /* For string tokens, only value is available (type remains null) */
    $this->value = $token;
  }

  /**
   * Checks if token matches a specific TokenType
   * 
   * @param TokenType $type The token type to compare against
   * @return bool True if token type matches
   */
  public function is(TokenType $type): bool
  {
    /* Compare current token type with provided type */
    return $this->type === $type;
  }

  /**
   * Checks if token has a specific value
   * 
   * @param string $value The value to compare against
   * @return bool True if token value matches
   */
  public function isValue(string $value): bool
  {
    /* Compare current token value with provided value */
    return $this->value === $value;
  }

  /**
   * Checks if token is a symbol (string token without type)
   * 
   * @return bool True if token is a symbol (type is null)
   */
  public function isSymbol(): bool
  {
    /* Symbols are tokens without a specific type (operators, punctuation) */
    return $this->type === null;
  }  
}