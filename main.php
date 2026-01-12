<?php

use Websyspro\Commons\Call;
use Websyspro\Commons\Collection;

/*
$callA = Call::bodyToStr(
  function() {
    return "Hello Word!!";
  }
);
print_r($callA); */

/*
$callA = Call::bodyToStr(
  fn() => "Hello Word!!"
);

$callB = Call::bodyToStr(
  fn() => (
    "Hello Word!!"
  )
); */

class User {
  public int $Id;
  public string $name;
}

$callA = Call::bodyToStr( 
  fn( User $user ) => (
    $user->Id === 1 
                               && $user->name === "John Martins" && ( $user->name === "Admin" && 1 === 1 )
                               )
);

// $callB = Call::bodyToStr( 
//   function( User $user ) {
//     return $user->Id === 1 
//                                && $user->name === "John Martins";
//   }
// );

print_r($callA);