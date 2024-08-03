<?php

function getCodeSnippet (string $file, string $line, int $linesBefore = 5, int $linesAfter = 5): array|bool
{
   $startLine = max(1, $line - $linesBefore);
   $endLine = $line + $linesAfter;

   $code = file($file);
   $snippet = array_slice($code, $startLine - 1, $endLine - $startLine + 1, true);

   return [ 'rawCode' => file_get_contents($file), 'parsedCode' => $snippet ];
}