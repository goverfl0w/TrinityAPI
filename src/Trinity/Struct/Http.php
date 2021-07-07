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

namespace Trinity\Struct;

interface Http
{
  public function __construct(string $http, int $port = 80);
  public function call(string $type, string $path, array $payload = []);

  /** Accessor methods for getting private instances. */
  public function getHttp();
  public function getPort();
}

?>
