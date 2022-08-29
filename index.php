<?php
//  Дан массив A из N положительных целых чисел и целое число K.
//  Найдите максимально возможную четную сумму из K элементов массива A.

// Например A=[3,8,9,6,10], K=3, RESULT: 24


class Task
{
  protected array $a;
  protected int   $k;

  /**
   * Initial Data
   */
  public function __construct ($a, $k)
  {
    $this->a = $a;
    $this->k = $k;
  }

  /**
   * Отчистка массива от лишних значений
   *
   * @return Task
   * @throws ArithmeticError
   */
  public function clearArray (): Task {
    $this->a = array_filter($this->a, static function ($item) {
      if (!is_int($item)) {
        throw new ArithmeticError('Ошибка ввода данных массива');
      }
      return !($item % 2);
    });

    return $this;
  }

  public function result(): int {
    $arraySum = [];
    $i = 0;

    while ($i  <= count($this->a)) {
      try {
        $arraySum[] += $this->sum($i);
      } catch (ArithmeticError $e) {
        break;
      }
      $i++;
    }
    return max($arraySum);
  }

  /**
   * Math function. Sum from initial to K
   *
   * @param int $i
   *
   * @return int
   */
  private function sum (int $i): int {
    if (count($this->a) >= $i + $this->k) {
      return array_sum(array_slice($this->a, $i, $this->k));
    }

    throw new ArithmeticError('Конец массива');
  }
}

//  $task = new Task([
//      '1', 3, 2, 7, 8, 9, 10, 12, 15
//  ], 3);

  $task = new Task([
    22, 3, 2, 7, 8, 9, 10, 12, 15
  ], 3);

  try {
    $answer = $task->clearArray()
      ->result();
    var_dump($answer);
  } catch (ArithmeticError $e) {
    var_dump($e->getMessage());
  }





