<?php

namespace Websyspro\Commons;

use Websyspro\Commons\Shareds\ReflectFN;
use Websyspro\Commons\Enums\TokenType;
use Websyspro\Commons\Shareds\Token;
use ReflectionFunction;

class Call
{
  public static function reflect(
    callable $callable
  ): ReflectFN {
    $reflectFN = new ReflectionFunction( 
      $callable
    );

    return new ReflectFN(
      $reflectFN->getFileName(),
      $reflectFN->getStartLine(),
      $reflectFN->getEndLine()
    );
  }

  public static function tokensAll(
    Collection $code
  ): Collection {
    return new Collection(
      token_get_all(
        "<?php {$code->joinNotSpace()}"
      )
    );
  }

  public static function tokenFromCode(
    Collection $code
  ): Collection {
    return Call::tokensAll( $code )->mapper(
      fn( array|string $token ) => new Token($token)
    );
  }  

  public static function bodyNormalized(
    Collection $body
  ): string {
    $tokens = Call::tokensAll( $body );
    print_r($tokens);

    return $body->joinWithSpace();
  }

  public static function bodyToStr(
    callable $callable
  ): array{
    $tokens = Call::tokenFromCode(
      Call::reflect(
        $callable
      )->code()
    );

    print_r($tokens);

    // $isArrow = false;
    // $capture = false;
    // $level = 0;
    // $body = [];
    // $skipReturn = false; 

    // foreach( $tokens->all() as $token ){
    //   if( Util::isArray($token) && $token[0] === T_FN ) {
    //     $isArrow = true;
    //     continue;
    //   }

    //   if( $isArrow && Util::isArray($token) && $token[0] === T_DOUBLE_ARROW ) {
    //     $capture = true;
    //     continue;
    //   }

    //   if( !$isArrow && $token === "{" ){
    //     $capture = true;
    //     $level = 1;
    //     $skipReturn = true;
    //     continue;
    //   }

    //   if( $capture ){
    //     if ($isArrow) {

    //       if ($token === ";" ) break;

    //       if ($token === ")" && $level === 0 ) break;

    //       if ($token === "(" ) $level++;
    //       if ($token === ")" ) $level--;

    //       $body[] = is_array($token) ? $token[1] : $token;
    //       continue;
    //     }

    //     if( !$isArrow ){
    //       if( $skipReturn && is_array($token) && $token[0] === T_RETURN ){
    //         $skipReturn = false;
    //         continue;
    //       }

    //       if( !$skipReturn && $token === ";" ){
    //         break;
    //       }

    //       if( $token === "{" ) $level++;

    //       if( $token === "}" ){
    //         $level--;
    //         if ($level === 0) break;
    //       }

    //       $body[] = Util::isArray( $token ) ? $token[1] : $token;
    //     }
    //   }
    // }

    return [
      "parameters" => [],
      "body" => []
    ];
  }
}