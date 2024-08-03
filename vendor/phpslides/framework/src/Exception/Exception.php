<?php


namespace PhpSlides;

use Exception as DefaultException;

class Exception extends DefaultException
{
   public function getDetailedMessage ()
   {
      $trace = $this->filterStackTrace($this->getTrace());

      if (!empty($trace))
      {
         $file = $trace[0]['file'];
         $line = $trace[0]['line'];
      }
      else
      {
         $file = $this->getFile();
         $line = $this->getLine();
      }
      return sprintf(
          "Error: %s in %s on line %d",
          $this->getMessage(),
          $file,
          $line
      );
   }

   private function filterStackTrace ($trace)
   {
      /**
       * This Filter and removes all file path that is coming from the vendor folders
       */
      $majorFilter = array_filter($trace, function ($item)
      {
         $ss = strpos($item['file'], '/vendor/') === false;
         $sss = strpos($item['file'], '\vendor\\') === false;

         return $ss && $sss === true;
      });

      /**
       * This filters and add only file path from the vendor folders
       */
      $minorFilter = array_filter($trace, function ($item)
      {
         $ss = strpos($item['file'], '/vendor/') === false;
         $sss = strpos($item['file'], '\vendor\\') === false;

         return $ss && $sss === false;
      });

      /**
       * Create a new array and merge them together
       * Major filters first
       * Then the Minor filters follows
       */
      $majorFilterValue = array_values($majorFilter);
      $minorFilterValue = array_values($minorFilter);
      $newFilter = array_merge($majorFilterValue, $minorFilterValue);

      return $newFilter;
   }

   public function getFilteredFile ()
   {
      $trace = $this->filterStackTrace($this->getTrace());

      if (!empty($trace))
      {
         return $trace[0]['file'];
      }
      return $this->getFile();
   }

   public function getFilteredLine ()
   {
      $trace = $this->filterStackTrace($this->getTrace());
      if (!empty($trace))
      {
         return $trace[0]['line'];
      }
      return $this->getLine();
   }

   public function getCodeSnippet ($linesBefore = 5, $linesAfter = 5)
   {
      $file = $this->getFilteredFile();
      $line = $this->getFilteredLine();
      $startLine = max(1, $line - $linesBefore);
      $endLine = $line + $linesAfter;

      $code = file($file);
      $snippet = array_slice($code, $startLine - 1, $endLine - $startLine + 1, true);

      return $snippet;
   }
}