<?php
/**
 * echo
 *
 * Devuelve el contetnido pasado por post para ser descargado en excel
 *
 * @package    global
 */

  $filename = $_POST["filename"];
  $content = $_POST["content"];
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");
  echo $content;