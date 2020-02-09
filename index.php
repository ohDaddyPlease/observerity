<?php

/**
 * Класс "Субъект".
 * Сервис, на котоорый осуществляется подписка и который производит манипуляции с ними
 */
class Subject implements SplSubject
{

  /**
   * Хранилище наблюдателей
   *
   * @var [SplObjectStorage]
   */
  public $observers;

  public function __construct()
  {
    $this->observers = new \SplObjectStorage;
  }

  /**
   * Поодписывает набдюдателя, помещая его в хранилище SplObjectStorage
   *
   * @param \SplObserver $observer
   * @return void
   */
  public function attach(\SplObserver $observer)
  {
    $this->observers->attach($observer);
  }

  /**
   * Отписывает наблюдателя (убирает из хранилища SplObjectStorage)
   *
   * @param \SplObserver $observer
   * @return void
   */
  public function detach(\SplObserver $observer)
  {
    $this->observers->detach($observer);
  }

  /**
   * Оповещает наблюдателей, вызывая их метод для оповещения
   *
   * @return void
   */
  public function notify()
  {
    foreach($this->observers as $observer)
    {
      $observer->update($this);
    }
  }

}

/**
 * Класс "Наблюдатель".
 * Объект ("клиент"), который будет подписан на субъект SplSubject
 */
class Observer implements SplObserver
{

  /**
   * Метод, вызывающийся после оповещения наблюдателя субъектом
   *
   * @param \SplSubject $subject
   * @return void
   */
  public function update(\SplSubject $subject)
  {
    (var_dump(
    $subject
    ));
  }

}

$testSubject = new Subject(); //создание субъекта (сервиса)

$testObserver1 = new Observer(); //создание наблюдателя (клиента)

$testSubject->attach($testObserver1); //подписание наблюдателя testObserver1 на субъект testSubject

$testSubject->notify(); //оповещение всех (всей базы) наблюдателей об изменениях в сервисе