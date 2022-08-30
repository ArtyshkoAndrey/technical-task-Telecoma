<?php
//  Дан массив A из N положительных целых чисел и целое число K.
//  Найдите максимально возможную четную сумму из K элементов массива A.

// Например A=[3,8,9,6,10], K=3, RESULT: 24

class Task
{
  private array $a;
  private int   $k;

  /**
   * Initial Data
   */
  public function __construct ($a, $k)
  {
    $this->a = $a;
    $this->k = $k;
  }

  /**
   *
   *
   * @return int
   */
  public function result (): int {
    $max = 0;
    $prepareMax = 0;
    $this->shellSort();
    $i = 0;

    $evenArray = [];
    $oddArray = [];
    foreach ($this->a as $item) {
      if ($item % 2 === 0) {
        $evenArray[] += $item;
      } else {
        $oddArray[] += $item;
      }
    }
    return $this->searchMax($evenArray, $oddArray);
  }

  private function searchMax($evenArray, $oddArray) {
    $prepareAnswer = 0;
    $arrayGetsOdd = [];
    $flagOdd = false;
    $eventMaxNumCount = 0;
    for ($i = 0; $i < max(count($oddArray), count($evenArray)); $i++) {
      $maxElement = max($evenArray[$i], $oddArray[$i]);

      if ($maxElement === $oddArray[$i]) {
        $flagOdd = !$flagOdd;
        $arrayGetsOdd[] += $i;
      } else {
        if (count($arrayGetsOdd) > $eventMaxNumCount) {
          $maxElement = $evenArray[$arrayGetsOdd[$eventMaxNumCount]];
          $eventMaxNumCount++;
        }
      }
      $prepareAnswer += $maxElement;

      if ($i + 1 === $this->k) {
        if ($flagOdd) {
          $prepareAnswer = $prepareAnswer - $oddArray[$arrayGetsOdd[0]] + $evenArray[$arrayGetsOdd[0]];
        }
        return $prepareAnswer;
      }
    }
    return -1;


  }

  /**
   * Быстрая сортировка методом шелла
   *
   * @return void
   */
  private function shellSort(): void
  {
    $k=0;
    $count = count($this->a);
    $gap[0] = (int) ($count / 2);

    while($gap[$k] > 1) {
      $k++;
      $gap[$k]= (int)($gap[$k-1] / 2);
    }

    for($i = 0; $i <= $k; $i++){
      $step=$gap[$i];

      for($j = $step; $j < $count; $j++) {
        $temp = $this->a[$j];
        $p = $j - $step;
        while($p >= 0 && $temp >  $this->a[$p]) {
          $this->a[$p + $step] =  $this->a[$p];
          $p                   -= $step;
        }
        $this->a[$p + $step] = $temp;
      }
    }
  }
}

//$task = new Task([9,17,21,14,16,14], 3);
$task = new Task(range(0,10000), 500);

$answer = $task->result();
var_dump($answer);





