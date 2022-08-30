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
   * (Худшее -> O(n)) + O(n log2 n) Скорось работы аолгоритма. Версия алгоритма решения задачи № 7
   *
   * @return int
   */
  public function result (): int {
    $max = 0;
    $prepareMax = 0;
    $this->shellSort();
    $i = 0;
    foreach ($this->a as $key => $item) {
      $prepareMax += $item;
      $i++;
      if ($i % $this->k === 0 && $key !== 0) {
        $max = $prepareMax % 2 === 0 ? max($max, $prepareMax) : $max;
//        $prepareMax -= $this->a[$key + 1 - $this->k];
//        $i--;
        break;
      }
    }
    return $max;
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

$task = new Task([9,17,21,14,16,14], 3);

$answer = $task->result();
var_dump($answer);





