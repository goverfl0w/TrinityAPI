<?php

/**
 * This file is respectively apart of the TrinityAPI project.
 *
 * Copyright (c) 2021-present James Walston
 * Some rights are reserved.
 *
 * This copyright is subject to the MIT license which
 * fully entails the details in the LICENSE file.
 */

namespace Trinity\API\Exception;

/**
 * The Base Exception class.
 * This allows for exceptions to be made when
 * the internal scripts hit any kind of sysematic
 * error.
 */
class Exception
{
  /** @var mixed */
  public $message;

  /** Special throwing rules. */
  public const THROW_NONE    = 0;
  public const THROW_DEFAULT = 1;

  /**
   * Creates an Exception class.
   *
   * @param   string     $message   The message of the error.
   * @param   const|null $type      The throwing type.
   * @return  void
   */
  public function __construct(string $message = null, $type = self::THROW_DEFAULT)
  {
    $this->message = $message;

    switch($type)
    {
      case self::THROW_NONE:
        break;

      default:
        die($this->message);
        break;
    }
  }
}

?>
