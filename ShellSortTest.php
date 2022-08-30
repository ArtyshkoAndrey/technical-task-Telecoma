<?php
require ('Task.php');

use PHPUnit\Framework\TestCase;

class ShellSortTest extends TestCase
{

  public function testSort(): void
  {
    $array = [4, 3, 99, 21, 3, 1, 6];

    $shellSortArray = (new Task($array, 3))->shellSort($array);
    sort($array, SORT_NUMERIC);
    $array = array_reverse($array);

    $this->assertEquals($array, $shellSortArray);

  }

  public function testResult(): void {
    $task = new Task([9,17,21,14,16,14], 3);
    $answer = $task->result();
    $this->assertEquals(54, $answer);
  }

  /**
   * @throws Exception
   */
  public function testResultWithRandomData(): void {
//    $array = range(1, random_int(2, 99));
//    shuffle($array);
//    $K = 3;
//
//    $task = new Task($array, $K);
//    $answer = $task->result();
//    var_dump($answer);
//    $masNumber = [];
//    $answerBogdan = max(self::sum($array, 0, $K, 0, $masNumber));
//    $this->assertEquals($answerBogdan, $answer);

    $count = rand(1, 99);
    while ($count > 0) {
      $array = range(1, random_int(2, 99));
      shuffle($array);
      $K = 3;

      $task = new Task($array, $K);
      $answer = $task->result();
      var_dump($answer);
      $masNumber = [];
      $answerBogdan = max(self::sum($array, 0, $K, 0, $masNumber));
      $this->assertEquals($answerBogdan, $answer);
      $count--;
    }
  }

  public static function sum(array $arr, $start, $deep, $currSum, array &$masNumber): array
  {
    if ($deep === 1) {
      for ($i = $start, $iMax = count($arr); $i < $iMax; $i++) {
        if (($currSum + $arr[$i]) % 2 === 0) {
          $masNumber[] += $currSum + $arr[$i];
        }
      }
    } else {
      for ($i = $start, $iMax = count($arr); $i < $iMax; $i++) {
        self::sum($arr, $i + 1, $deep - 1, $currSum + $arr[$i], $masNumber);
      }
    }
    return $masNumber;

  }

}
