<?php

namespace Websyspro\Commons;

use Websyspro\Commons\Shareds\ReflectFN;
use Websyspro\Commons\Shareds\Token;
use ReflectionFunction;
use Websyspro\Commons\Enums\TokenType;

/**
 * Call - Utility class for callable reflection and token analysis
 * 
 * This class provides static methods to analyze callable functions,
 * extract their source code, tokenize content, and normalize function bodies.
 * It supports both arrow functions and regular functions with proper token parsing.
 */
class Call
{
  /**
   * Creates a ReflectFN object from a callable function
   * 
   * @param callable $callable The function to reflect
   * @return ReflectFN Object containing file path and line information
   */
  public static function reflect(
    callable $callable
  ): ReflectFN {
    /* Create PHP reflection object for the callable */
    $reflectFN = new ReflectionFunction( 
      $callable
    );

    /* Return custom ReflectFN with file and line information */
    return new ReflectFN(
      $reflectFN->getFileName(),
      $reflectFN->getStartLine(),
      $reflectFN->getEndLine()
    );
  }

  /**
   * Tokenizes PHP code into a collection of tokens
   * 
   * @param Collection $code Collection containing PHP code lines
   * @return Collection Collection of PHP tokens
   */
  public static function tokensAll(
    Collection $code
  ): Collection {
    /* Use PHP's token_get_all to parse code with PHP opening tag */
    return new Collection(
      token_get_all(
        "<?php {$code->joinNotSpace()}"
      )
    );
  }

  /**
   * Converts code tokens into Token objects
   * 
   * @param Collection $code Collection containing PHP code
   * @return Collection Collection of Token objects
   */
  public static function tokenFromReflect(
    Collection $code
  ): Collection {
    /* Get all tokens and map them to Token objects */
    return Call::tokensAll( $code )->mapper(
      fn( array|string $token ) => new Token($token)
    );
  }  

  /**
   * Normalizes function body by tokenizing and joining with spaces
   * 
   * @param Collection $body Collection containing function body code
   * @return string Normalized code string with proper spacing
   */
  public static function bodyNormalized(
    Collection $body
  ): string {
    /* Tokenize the body and join tokens with proper spacing */
    return Call::tokensAll( $body )->joinWithSpace();
  }

  /**
   * Extracts the body content from a callable function
   * 
   * Supports both arrow functions (fn() => ...) and regular functions.
   * Handles nested parentheses and braces properly.
   * 
   * @param callable $callable The function to extract body from
   * @return Collection Collection containing the function body tokens
   */
  public static function bodyToStr(
    callable $callable
  ): mixed {
    /* Get tokens from the reflected callable function */
    $tokens = Call::tokenFromReflect(
      Call::reflect( 
        $callable
      )->code()
    );

    /* Initialize variables for parsing state */
    $body = new Collection();
    $isArrow = false; /* Flag for arrow function detection */
    $capture = false; /* Flag to start capturing body tokens */
    $level = 0; /* Nesting level for parentheses/braces */
    $skipReturn = false; /* Flag to skip return keyword in regular functions */

    /* Parse through all tokens to extract function body */
    foreach( $tokens->all() as $token ){
      /* Detect arrow function (fn keyword) */
      if( $token->is( TokenType::T_FN )){
        $isArrow = true;
        continue;
      }

      /* Start capturing after arrow (=>) in arrow functions */
      if( $isArrow && $token->is( TokenType::T_DOUBLE_ARROW )){
        $capture = true;
        continue;
      }

      /* Start capturing after opening brace in regular functions */
      if( $isArrow === false && $token->isValue( "{" )){
        $skipReturn = true;
        $capture = true;
        $level = 1;
        continue;
      }

      /* Skip tokens before body capture starts */
      if( $capture === false ){
        continue;
      }

      /* Skip whitespace tokens */
      if( $token->is( TokenType::T_WHITESPACE )){
        continue;
      }      

      /* Handle arrow function body extraction */
      if( $isArrow === true ){
        /* End capture at semicolon */
        if( $token->isValue( ";" ) === true ){
          break;
        }

        /* End capture at closing parenthesis at level 0 */
        if( $token->isValue( ")" ) && $level === 0 ){
            break;
        }

        /* Track parentheses nesting level */
        if( $token->isValue( "(" )) $level++;
        if( $token->isValue( ")" )) $level--;

        /* Add token to body collection */
        $body->add( $token->value );
        continue;
      }

      /* Handle regular function body extraction */
      if( $isArrow === false ){
        /* Skip the return keyword at the beginning */
        if( $skipReturn === true && $token->is( TokenType::T_RETURN )){
          $skipReturn = false;
          continue;
        }

        /* End capture at semicolon after return is processed */
        if( $skipReturn === false && $token->isValue( ";" )){
          break;
        }

        /* Track opening braces */
        if( $token->isValue( "{" )){
          $level++;
        }

        /* Track closing braces and end at level 0 */
        if( $token->isValue( "}" )){
          $level--;
          if( $level === 0 ){
            break;
          }
        }

        /* Add token to body collection */
        $body->add( $token->value );
      }
    }

    return $body->reduce(
      [], 
      function( array $curr, string $item ) {
        $arrBreakGroup = [
          "&&", "and", "||", "or", "(", ")"
        ];

        $currIndex = Util::sizeArray( 
          $curr
        );

        if( Util::inArray( $item, $arrBreakGroup )){
          $curr[ $currIndex ] = $item;
          return $curr;
        }

        if( Util::sizeArray($curr) === 0 ){
          $curr[ $currIndex ] = [];
        }

        $curr[ $currIndex ][] = $item;
        return $curr;
      }
    );
  }
}