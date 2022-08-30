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
   * O(n) Скорось работы аолгоритма. Версия алгоритма решения задачи № 5
   *
   * @return int
   */
  public function result (): int {
   $max = 0;
   $prepareMax = 0;
   $i = 0;
   foreach ($this->a as $key => $item) {
     $prepareMax += $item;
     $i++;
     if ($i % $this->k === 0 && $key !== 0) {
       $max = $prepareMax % 2 === 0 ? max($max, $prepareMax) : $max;
       $prepareMax -= $this->a[$key + 1 - $this->k];
       $i--;
     }
   }
   return $max;
  }
}

  $task = new Task([9,17,21,14,16,14], 3);

  $answer = $task->result();
  var_dump($answer);





