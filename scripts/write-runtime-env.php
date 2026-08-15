<?php

declare(strict_types=1);

$lines = [];

foreach (getenv() as $key => $value) {
  if (! is_string($value) || ! preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $key)) {
    continue;
  }

  $lines[] = $key.'='.$value;
}

file_put_contents('/app/.env', implode("\n", $lines)."\n");
