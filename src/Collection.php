<?php

namespace Websyspro\Commons;

use Attribute;

/**
 * Attribute-based collection wrapper that provides
 * functional-style operations over arrays.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Collection
{
  /**
   * Creates a new Collection instance.
   *
   * @param array $items Initial collection items
   */  
  public function __construct(
    public Collection|array $items = []
  ){}

  /**
   * Adds a single item to the collection.
   *
   * @param mixed $item Item to add
   *
   * @return Collection Fluent instance
   */  
  public function add(
    mixed $item, 
    mixed $key = null
  ): Collection {
    if( $key !== null ){
      $this->items[ $key ] = $item;
      return $this;
    } 

    $this->items[] = $item;
    return $this;
  }

  /**
   * Merges another collection or array into the current collection.
   *
   * @param Collection|array $array Collection or array to merge
   *
   * @return Collection Fluent instance
   */  
  public function merge(
    Collection|array $array 
  ): Collection {
    $this->items = $array instanceof Collection
      ? array_merge( $this->items, $array->all()) 
      : array_merge( $this->items, $array );

    return $this;
  }

  /**
   * Maps each item in the collection using a callable.
   *
   * @param callable|object $fn Mapping function
   *
   * @return Collection New mapped collection
   */  
  public function mapper(
    callable|object $fn
  ): Collection {
    if(is_callable( $fn ) === false){
      return new Collection(
        Util::mapper(
          $this->items, fn(mixed $item) => (
              Util::hydrate( $item, $fn )
            ) 
          )
      );
    }

    return new Collection(
      Util::mapper(
        $this->items, $fn
      )
    );
  }

  /**
   * Filters the collection based on a condition.
   *
   * @param callable $fn Filter callback
   *
   * @return Collection Filtered collection
   */  
  public function where(
    callable $fn
  ): Collection {
    return new Collection(
      Util::where( 
        $this->items, $fn
      )
    );
  }

  /**
   * Finds the first item that matches the condition.
   *
   * @param callable $fn Predicate function
   *
   * @return mixed First matched item or null
   */  
  public function find(
    callable $fn
  ): mixed {
    return Util::find(
      $this->items, $fn
    );
  }

 
  /**
   * Gets an item by index or key.
   *
   * @param int|string $item Index or key to retrieve
   *
   * @return Collection Collection containing the item
   */
  public function get(
    int|string $item
  ): mixed {
    return $this->items[ $item ] ?? null;
  }
  
  /**
   * Gets an item by index or key.
   *
   * @param array $items Index or key to retrieve
   *
   * @return Collection Collection containing the item
   */
  public function gets(
    array $items
  ): Collection {
    /* Return item by string key or numeric index */
    return new Collection(
      Util::gets( $this->items, $items )
    );
  }   

  /**
   * Reduces the collection to a single value.
   *
   * @param mixed    $curremt Initial value
   * @param callable $fn      Reduce callback
   *
   * @return mixed Reduced value
   */  
  public function reduce(
    mixed $curremt,
    callable $fn
  ): mixed {
    return new Collection(
      Util::reduce(
        $this->items, $fn, $curremt
      )
    );
  }

  /**
   * Extracts a portion of the collection.
   *
   * @param int      $start  Start index
   * @param int|null $lenght Length of the slice
   *
   * @return Collection New sliced collection
   */  
  public function slice(
    int $start,
    int|null $lenght = null
  ): Collection {;
    return new Collection(array_slice($this->items, $start, $lenght));
  }
  
  /**
   * Splits the collection into chunks.
   *
   * @param int $length Size of each chunk
   *
   * @return Collection Fluent instance
   */  
  public function chunk(
    int $length
  ): Collection {
    return new Collection(
      Util::chunk(
        $this->items,
        $length
      )
    );
  }

  public function values(
  ): Collection {
    return new Collection(
      array_values(
        $this->items
      )
    );
  }

  public function keys(
  ): Collection {
    return new Collection(
      array_keys(
        $this->items
      )
    );
  } 

  /**
   * Removes duplicate items based on a specific field.
   *
   * @param string $field Field name to check for duplicates
   *
   * @return Collection Collection without duplicates
   */
  function removeDuplicates(
    string $field
  ): Collection {
    $unicos = [];
    $vistos = [];

    /* Iterate through items and track unique field values */
    foreach ($this->items as $item) {
      if (is_object($item)) {
        if (!property_exists($item, $field)) {
          continue;
        }

        $valor = $item->{$field};
      } else {
        if (!array_key_exists($field, $item)) {
          continue;
        }
        
        $valor = $item[$field];
      }

      /* Add item only if field value hasn't been seen before */
      if (!isset($vistos[$valor])) {
        $vistos[$valor] = true;
        $unicos[] = $item;
      }
    }

    return new Collection(
      $unicos
    );
  }  

  /**
   * Joins collection items into a string.
   *
   * @param string $join Separator
   *
   * @return string Joined string
   */  
  public function join(
    string $join = ""
  ): string {
    return implode( $join, $this->items );
  }

  /**
   * Returns the string representation of the current instance.
   *
   * This method delegates the conversion to the internal `join()` method,
   * which is responsible for generating the final string output.
   *
   * @return string The resulting string representation.
   */
  public function toString(
  ): string {
    return $this->join();
  } 

  /**
   * Joins items using a comma and space.
   *
   * @return string
   */  
  public function joinWithComma(
  ): string {
    return $this->join( ", " );
  }

  /**
   * Joins items using a space.
   *
   * @return string
   */  
  public function joinWithSpace(
  ): string {
    return $this->Join( " " );
  }

  /**
   * Joins items without any separator.
   *
   * @return string
   */  
  public function joinNotSpace(
  ): string {
    return $this->Join( "" );
  }

  /**
   * Joins items using a line break.
   *
   * @return string
   */  
  public function joinWithBreak(
  ): string {
    return $this->Join( "\r\n" );
  }

  /**
   * Returns the number of items in the collection.
   *
   * @return int
   */  
  public function count(
  ): int {
    return sizeof($this->items);
  }

  /**
   * Checks if the collection contains any items.
   *
   * @return bool
   */  
  public function exist(
  ): bool {
    return sizeof($this->items) !== 0;
  }
  
  /**
   * Calculates the sum of mapped values.
   *
   * @param callable $callable Mapping function
   *
   * @return float
   */  
  public function sum(
    callable $callable
  ): float {
    return array_sum(
      Util::mapper( 
        $this->items, $callable
      )
    );
  }

  /**
   * Returns the item at a specific index.
   *
   * @param int $eq Index
   *
   * @return Collection Single-item collection
   */  
  public function eq(
    int|string $eq
  ): Collection {
    if( is_string( $eq )){
      return new Collection(
        $this->items[ $eq ]
      );
    }

    return new Collection(
      Util::slice(
        $this->items,
        $eq,
        1
      )
    );
  }

  /**
   * Returns the first item in the collection.
   *
   * @return mixed
   */
  public function first(
  ): mixed {
    return reset( $this->items );
  }

  /**
   * Returns the last item in the collection.
   *
   * @return mixed
   */  
  public function last(
  ): mixed {
    return end( $this->items );
  } 

  /**
   * Finds the index of the first item matching the condition.
   *
   * @param callable $fn Predicate function
   *
   * @return int Index of the matched item or -1 if not found
   */
  public function indexOf(
    callable $fn
  ): int {
    /* Return the index of the first matching item */
    return Util::indexOf(
      $this->items, $fn
    );
  }  
  
  /**
   * Sorts the collection by keys in ascending order.
   *
   * @return Collection Sorted collection
   */  
  public function orderByAsc(
  ): Collection {
    ksort($this->items);
    return new Collection($this->items);
  }

  /**
   * Returns all items as a raw array.
   *
   * @return array
   */  
  public function all(): array {
    return $this->items;
  }

  /**
   * Sets a value at the specified index in the collection.
   *
   * @param int   $index Index to set
   * @param mixed $value Value to assign
   *
   * @return Collection Fluent instance
   */
  public function setValue(
    int $index,
    mixed $value
  ): Collection {
    $this->items[ $index ] = $value;
    return $this;
  }

  /**
   * Removes and returns a portion of the collection.
   *
   * @param int      $offset Start position
   * @param int|null $length Number of items to remove
   *
   * @return Collection Collection with removed items
   */
  public function spliceOut(
    int $offset,
    int|null $length = null,
  ): Collection {
    return new Collection(
      array_splice( $this->items, $offset, $length )
    );
  }

  /**
   * Replaces a portion of the collection with new items.
   *
   * @param int              $offset      Start position
   * @param int|null         $length      Number of items to replace
   * @param Collection|array $replacement Items to insert
   *
   * @return Collection Fluent instance
   */
  public function spliceIn(
    int $offset,
    int $lenght,
    Collection|array $replacement
  ): Collection {
    array_splice( $this->items, $offset, $lenght, 
      $replacement instanceof Collection 
        ? $replacement->all() 
        : $replacement 
    );
    
    return $this;
  }  
}