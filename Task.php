<?php
//  Дан массив A из N положительных целых чисел и целое число K.
//  Найдите максимально возможную четную сумму из K элементов массива A.
// Например A=[3,8,9,6,10], K=3, RESULT: 24


class Task
{
  private array $a;
  private int   $k;
  public int $iter = 0;

  /**
   * Initial Data
   */
  public function __construct ($a, $k)
  {
    $this->a = $a;
    $this->k = $k;
  }

  /**
   * O(count(a)) + O(k) + O(count(a)*log2 count(a))
   *
   * @return int
   */
  public function result (): int {
    $this->shellSort();

    $evenArray = [];
    $oddArray = [];
    foreach ($this->a as $item) {
      $this->iter++;
      if ($item % 2 === 0) {
        $evenArray[] += $item;
      } else {
        $oddArray[] += $item;
      }
    }
    return $this->searchMax($evenArray, $oddArray);
  }

  private function searchMax($evenArray, $oddArray) {
//    var_dump($evenArray, $oddArray);
    $prepareAnswer = 0;
    $flagOdd = false;
    $evenCounter = 0;
    $oddCounter = 0;
    for ($i = 0; $i <= $this->k; $i++) {
      $maxElement = max($evenArray[$evenCounter], $oddArray[$oddCounter]);
//      var_dump('Max = ' . $maxElement);
//      var_dump('Even = ' . $evenArray[$evenCounter]);
//      var_dump('Odd = ' . $oddArray[$oddCounter]);
      $this->iter++;
      if ($maxElement === $oddArray[$oddCounter]) {
        $flagOdd = !$flagOdd;
        $oddCounter++;
      } else {
        $evenCounter++;
      }
      $prepareAnswer += $maxElement;
      if ($i + 1 === $this->k) {
        if ($flagOdd) {
          $prepareAnswer = $prepareAnswer - $oddArray[$oddCounter--] + $evenArray[$evenCounter];
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
  public function shellSort(array $array = null): array
  {
    if ($array) {
      $this->a = $array;
    }

    $k=0;
    $count = count($this->a);
    $gap[0] = (int) ($count / 2);

    while($gap[$k] > 1) {
      $this->iter++;
      $k++;
      $gap[$k]= (int)($gap[$k-1] / 2);
    }

    for($i = 0; $i <= $k; $i++){
      $step=$gap[$i];

      for($j = $step; $j < $count; $j++) {
        $temp = $this->a[$j];
        $p = $j - $step;
        while($p >= 0 && $temp >  $this->a[$p]) {
          $this->iter++;
          $this->a[$p + $step] =  $this->a[$p];
          $p                   -= $step;
        }
        $this->a[$p + $step] = $temp;
      }
    }

    return $this->a;
  }
}

//$task = new Task([9,17,21,14,16,14], 3);
////$task = new Task([1, 1, 1, 2], 4);
//
//$answer = $task->result();
//if ($answer < 0) {
//  var_dump('Нет решения');
//} else {
//  var_dump('Ответ = ' . $answer, 'Всего итераций: ' . $task->iter);
//}





