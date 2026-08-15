<?php

declare(strict_types=1);

/**
 * Write a dotenv-safe /app/.env from container env.
 * Skip Nix/shell paths (they contain spaces) and quote remaining values.
 */
$skipExact = [
  'PATH', 'HOME', 'USER', 'LOGNAME', 'SHELL', 'PWD', 'OLDPWD', 'SHLVL',
  'TERM', 'HOSTNAME', 'LANG', 'TMPDIR', '_',
];

$lines = [];

foreach (getenv() as $key => $value) {
  if (! is_string($value) || ! preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $key)) {
    continue;
  }

  if (in_array($key, $skipExact, true) || preg_match('/^(NIX_|LC_|SSH_|LS_)/', $key) === 1) {
    continue;
  }

  $escaped = str_replace(['\\', '"', "\n", "\r"], ['\\\\', '\\"', '\\n', '\\r'], $value);
  $lines[] = $key.'="'.$escaped.'"';
}

file_put_contents('/app/.env', implode("\n", $lines)."\n");
