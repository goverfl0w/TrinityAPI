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

namespace Trinity\API;
use Trinity\Struct;
use Trinity\API\Exception;

/**
 * Represents the HTTP class for the API.
 *
 * This helps with declaring how HTTP calls work
 * when trying to interact with URL and URI paths.
 * Also, it teaches how requests will function.
 */
class Http implements Struct\Http
{
  public const POST = "POST";
  public const GET = "GET";

  /** @var string */
  private $http;

  /** @var int */
  private $port;

  /**
   * Creates an Http class instance.
   *
   * @param   string  $http The HTTP path you're calling.
   * @param   int     $port The HTTP port you're inferring.
   * @return  void
   */
  public function __construct(string $http, int $port = 80)
  {
    $this->http = $http;
    $this->port = $port;
  }

  /**
   * Calls the HTTP path with a specified request.
   * Has to meet with the constants of currently
   * accepted HTTP requests compatible with the API.
   *
   * @param   string  $type The HTTP request you're using.
   * @param   string  $path The HTTP path you're calling.
   * @param   array   $payload Additional information you want to pass on as JSON.
   * @return  array
   */
  public function call(string $type, string $path, array $payload = []): array
  {
    /**
     * Determine the type of call in a temporary
     * variable to later pass on as information.
     * (PHP 8+ method commented below.)
     */
    switch($type)
    {
      case self::POST:
        $_type = "POST";
        break;

      case self::GET:
        $_type = "GET";
        break;

      default:
        $_type = null;
        break;
    }

    /** Determine what our response status code is. */
    $_headers = ($_type) ? get_headers($path) : "400";
    $_response = substr($_headers[0], 9, 3);

    if($_response === "401") $_response = "200";
    elseif($_response != "200") throw new Exception\Exception("You have encountered a rate limit.");

    /** Now provide the information for the structure. */
    $_path = ($_response === "200") ? $path : null;
    $_payload = (!$payload) ? $payload : null;

    /**
     * All returned information will be formatted this way.
     * This will make grabbing argument values easier
     * when handling the HTTP requests.
     */
    return
    [
      "type"    => $_type,
      "path"    => $_path,
      "status"  => $_response,
      "json"    => $_payload
    ];
  }

  /**
   * Gets the HTTP address.
   *
   * @return string
   */
  public function getHttp(): string
  {
    return $this->http;
  }

  /**
   * Gets the HTTP communication endpoint.
   *
   * @return int
   */
  public function getPort(): int
  {
    return $this->port;
  }
}

?>
