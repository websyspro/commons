<?php

namespace Websyspro\Commons\Enums;

/**
 * TokenType - Enumeration of PHP token types
 * 
 * This enum provides a type-safe wrapper around PHP's built-in token constants.
 * Each case corresponds to a specific PHP token type used by token_get_all().
 * Used for token identification and comparison in code parsing operations.
 */
enum TokenType: int
{
  /* Language construct tokens */
  case T_ABSTRACT = T_ABSTRACT;                     /* abstract keyword */
  case T_AS = T_AS;                                 /* as keyword */
  case T_BREAK = T_BREAK;                           /* break keyword */
  case T_CASE = T_CASE;                             /* case keyword */
  case T_CATCH = T_CATCH;                           /* catch keyword */
  case T_CLASS = T_CLASS;                           /* class keyword */
  case T_CLONE = T_CLONE;                           /* clone keyword */
  case T_CONST = T_CONST;                           /* const keyword */
  case T_CONTINUE = T_CONTINUE;                     /* continue keyword */
  case T_DECLARE = T_DECLARE;                       /* declare keyword */
  case T_DEFAULT = T_DEFAULT;                       /* default keyword */
  case T_DO = T_DO;                                 /* do keyword */
  case T_ECHO = T_ECHO;                             /* echo keyword */
  case T_ELSE = T_ELSE;                             /* else keyword */
  case T_ELSEIF = T_ELSEIF;                         /* elseif keyword */
  case T_EMPTY = T_EMPTY;                           /* empty() function */
  case T_ENDDECLARE = T_ENDDECLARE;                 /* enddeclare keyword */
  case T_ENDFOR = T_ENDFOR;                         /* endfor keyword */
  case T_ENDFOREACH = T_ENDFOREACH;                 /* endforeach keyword */
  case T_ENDIF = T_ENDIF;                           /* endif keyword */
  case T_ENDSWITCH = T_ENDSWITCH;                   /* endswitch keyword */
  case T_ENDWHILE = T_ENDWHILE;                     /* endwhile keyword */
  case T_ENUM = T_ENUM;                             /* enum keyword */
  case T_EVAL = T_EVAL;                             /* eval() function */
  case T_EXIT = T_EXIT;                             /* exit/die keyword */
  case T_EXTENDS = T_EXTENDS;                       /* extends keyword */
  case T_FINAL = T_FINAL;                           /* final keyword */
  case T_FINALLY = T_FINALLY;                       /* finally keyword */
  case T_FN = T_FN;                                 /* fn keyword (arrow functions) */
  case T_FOR = T_FOR;                               /* for keyword */
  case T_FOREACH = T_FOREACH;                       /* foreach keyword */
  case T_FUNCTION = T_FUNCTION;                     /* function keyword */
  case T_GLOBAL = T_GLOBAL;                         /* global keyword */
  case T_GOTO = T_GOTO;                             /* goto keyword */
  case T_HALT_COMPILER = T_HALT_COMPILER;           /* __halt_compiler() */
  case T_IF = T_IF;                                 /* if keyword */
  case T_IMPLEMENTS = T_IMPLEMENTS;                 /* implements keyword */
  case T_INCLUDE = T_INCLUDE;                       /* include keyword */
  case T_INCLUDE_ONCE = T_INCLUDE_ONCE;             /* include_once keyword */
  case T_INSTANCEOF = T_INSTANCEOF;                 /* instanceof operator */
  case T_INSTEADOF = T_INSTEADOF;                   /* insteadof keyword */
  case T_INTERFACE = T_INTERFACE;                   /* interface keyword */
  case T_ISSET = T_ISSET;                           /* isset() function */
  case T_LIST = T_LIST;                             /* list() function */
  case T_MATCH = T_MATCH;                           /* match keyword */
  case T_NAMESPACE = T_NAMESPACE;                   /* namespace keyword */
  case T_NEW = T_NEW;                               /* new keyword */
  case T_PRINT = T_PRINT;                           /* print keyword */
  case T_PRIVATE = T_PRIVATE;                       /* private keyword */
  case T_PROTECTED = T_PROTECTED;                   /* protected keyword */
  case T_PUBLIC = T_PUBLIC;                         /* public keyword */
  case T_READONLY = T_READONLY;                     /* readonly keyword */
  case T_REQUIRE = T_REQUIRE;                       /* require keyword */
  case T_REQUIRE_ONCE = T_REQUIRE_ONCE;             /* require_once keyword */
  case T_RETURN = T_RETURN;                         /* return keyword */
  case T_STATIC = T_STATIC;                         /* static keyword */
  case T_SWITCH = T_SWITCH;                         /* switch keyword */
  case T_THROW = T_THROW;                           /* throw keyword */
  case T_TRAIT = T_TRAIT;                           /* trait keyword */
  case T_TRY = T_TRY;                               /* try keyword */
  case T_UNSET = T_UNSET;                           /* unset() function */
  case T_USE = T_USE;                               /* use keyword */
  case T_VAR = T_VAR;                               /* var keyword */
  case T_WHILE = T_WHILE;                           /* while keyword */
  case T_YIELD = T_YIELD;                           /* yield keyword */
  case T_YIELD_FROM = T_YIELD_FROM;                 /* yield from keywords */

  /* Operator tokens */
  case T_AMPERSAND_FOLLOWED_BY_VAR_OR_VARARG = T_AMPERSAND_FOLLOWED_BY_VAR_OR_VARARG;     /* & before variable */
  case T_AMPERSAND_NOT_FOLLOWED_BY_VAR_OR_VARARG = T_AMPERSAND_NOT_FOLLOWED_BY_VAR_OR_VARARG; /* & operator */
  case T_AND_EQUAL = T_AND_EQUAL;               /* &= operator */
  case T_BOOLEAN_AND = T_BOOLEAN_AND;           /* && operator */
  case T_BOOLEAN_OR = T_BOOLEAN_OR;             /* || operator */
  case T_COALESCE = T_COALESCE;                 /* ?? operator */
  case T_COALESCE_EQUAL = T_COALESCE_EQUAL;     /* ??= operator */
  case T_CONCAT_EQUAL = T_CONCAT_EQUAL;         /* .= operator */
  case T_DEC = T_DEC;                           /* -- operator */
  case T_DIV_EQUAL = T_DIV_EQUAL;               /* /= operator */
  case T_DOUBLE_ARROW = T_DOUBLE_ARROW;         /* => operator */
  case T_DOUBLE_COLON = T_DOUBLE_COLON;         /* :: operator */
  case T_ELLIPSIS = T_ELLIPSIS;                 /* ... operator */
  case T_INC = T_INC;                           /* ++ operator */
  case T_IS_EQUAL = T_IS_EQUAL;                 /* == operator */
  case T_IS_GREATER_OR_EQUAL = T_IS_GREATER_OR_EQUAL; /* >= operator */
  case T_IS_IDENTICAL = T_IS_IDENTICAL;         /* === operator */
  case T_IS_NOT_EQUAL = T_IS_NOT_EQUAL;         /* != or <> operator */
  case T_IS_NOT_IDENTICAL = T_IS_NOT_IDENTICAL; /* !== operator */
  case T_IS_SMALLER_OR_EQUAL = T_IS_SMALLER_OR_EQUAL; /* <= operator */
  case T_LOGICAL_AND = T_LOGICAL_AND;           /* and operator */
  case T_LOGICAL_OR = T_LOGICAL_OR;             /* or operator */
  case T_LOGICAL_XOR = T_LOGICAL_XOR;           /* xor operator */
  case T_MINUS_EQUAL = T_MINUS_EQUAL;           /* -= operator */
  case T_MOD_EQUAL = T_MOD_EQUAL;               /* %= operator */
  case T_MUL_EQUAL = T_MUL_EQUAL;               /* *= operator */
  case T_NULLSAFE_OBJECT_OPERATOR = T_NULLSAFE_OBJECT_OPERATOR; /* ?-> operator */
  case T_OBJECT_OPERATOR = T_OBJECT_OPERATOR;   /* -> operator */
  case T_OR_EQUAL = T_OR_EQUAL;                 /* |= operator */
  case T_PLUS_EQUAL = T_PLUS_EQUAL;             /* += operator */
  case T_POW = T_POW;                           /* ** operator */
  case T_POW_EQUAL = T_POW_EQUAL;               /* **= operator */
  case T_SL = T_SL;                             /* << operator */
  case T_SL_EQUAL = T_SL_EQUAL;                 /* <<= operator */
  case T_SPACESHIP = T_SPACESHIP;               /* <=> operator */
  case T_SR = T_SR;                             /* >> operator */
  case T_SR_EQUAL = T_SR_EQUAL;                 /* >>= operator */
  case T_XOR_EQUAL = T_XOR_EQUAL;               /* ^= operator */

  /* Cast tokens */
  case T_ARRAY_CAST = T_ARRAY_CAST;             /* (array) cast */
  case T_BOOL_CAST = T_BOOL_CAST;               /* (bool) cast */
  case T_DOUBLE_CAST = T_DOUBLE_CAST;           /* (double) cast */
  case T_INT_CAST = T_INT_CAST;                 /* (int) cast */
  case T_OBJECT_CAST = T_OBJECT_CAST;           /* (object) cast */
  case T_STRING_CAST = T_STRING_CAST;           /* (string) cast */
  case T_UNSET_CAST = T_UNSET_CAST;             /* (unset) cast */

  /* Data type tokens */
  case T_ARRAY = T_ARRAY;                       /* array keyword */
  case T_CALLABLE = T_CALLABLE;                 /* callable keyword */
  case T_CONSTANT_ENCAPSED_STRING = T_CONSTANT_ENCAPSED_STRING; /* quoted string */
  case T_DNUMBER = T_DNUMBER;                   /* floating point number */
  case T_LNUMBER = T_LNUMBER;                   /* integer number */
  case T_STRING = T_STRING;                     /* string literal */
  case T_VARIABLE = T_VARIABLE;                 /* $variable */

  /* Magic constant tokens */
  case T_CLASS_C = T_CLASS_C;                   /* __CLASS__ constant */
  case T_DIR = T_DIR;                           /* __DIR__ constant */
  case T_FILE = T_FILE;                         /* __FILE__ constant */
  case T_FUNC_C = T_FUNC_C;                     /* __FUNCTION__ constant */
  case T_LINE = T_LINE;                         /* __LINE__ constant */
  case T_METHOD_C = T_METHOD_C;                 /* __METHOD__ constant */
  case T_NS_C = T_NS_C;                         /* __NAMESPACE__ constant */
  case T_TRAIT_C = T_TRAIT_C;                   /* __TRAIT__ constant */

  /* Name resolution tokens */
  case T_NAME_FULLY_QUALIFIED = T_NAME_FULLY_QUALIFIED; /* \Fully\Qualified\Name */
  case T_NAME_QUALIFIED = T_NAME_QUALIFIED;     /* Qualified\Name */
  case T_NAME_RELATIVE = T_NAME_RELATIVE;       /* namespace\relative\name */

  /* Special tokens */
  case T_ATTRIBUTE = T_ATTRIBUTE;               /* #[Attribute] */
  case T_BAD_CHARACTER = T_BAD_CHARACTER;       /* invalid character */
  case T_COMMENT = T_COMMENT;                   /* // or # comment */
  case T_DOC_COMMENT = T_DOC_COMMENT;           /* /** comment */
  case T_WHITESPACE = T_WHITESPACE;             /* whitespace characters */

  /* String parsing tokens */
  case T_CURLY_OPEN = T_CURLY_OPEN;             /* { in string interpolation */
  case T_DOLLAR_OPEN_CURLY_BRACES = T_DOLLAR_OPEN_CURLY_BRACES; /* ${ in strings */
  case T_ENCAPSED_AND_WHITESPACE = T_ENCAPSED_AND_WHITESPACE; /* string content */
  case T_START_HEREDOC = T_START_HEREDOC;       /* <<<HEREDOC */
  case T_STRING_VARNAME = T_STRING_VARNAME;     /* variable in string */

  /* PHP tag tokens */
  case T_CLOSE_TAG = T_CLOSE_TAG;               /* ?> tag */
  case T_INLINE_HTML = T_INLINE_HTML;           /* HTML outside PHP tags */
  case T_OPEN_TAG = T_OPEN_TAG;                 /* <?php tag */
  case T_OPEN_TAG_WITH_ECHO = T_OPEN_TAG_WITH_ECHO; /* <?= tag */
}