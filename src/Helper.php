<?php

namespace Source;

class Helper
{

  /**
   * Print a beautiful print
   */
  public static function beautifful_print(mixed $data): mixed
  {
    return print("<pre>" . print_r($data, true) . "</pre>");
  }
}
