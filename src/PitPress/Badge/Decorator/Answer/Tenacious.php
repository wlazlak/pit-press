<?php

/**
 * @file Tenacious.php
 * @brief This file contains the Tenacious class.
 * @details
 * @author Filippo F. Fadda
 */


namespace PitPress\Badge\Decorator\Answer;


use PitPress\Badge\Decorator\Decorator;
use PitPress\Enum\Metal;


/**
 * @brief Zero score accepted answers: more than 5 and 20% of total.
 * @details Awarded once.
 * @nosubgrouping
 */
class Tenacious extends Decorator {


  /**
   * @copydoc Decorator::getName()
   */
  public function getName() {
    return "Tenace";
  }


  /**
   * @copydoc Decorator::getBrief()
   */
  public function getBrief() {
    return <<<'DESC'
Hai fornito più di 5 risposte con punteggio pari a 0, che rappresentano almeno il 20% delle tue risposte. Assegnato una
sola volta.
DESC;
  }


  /**
   * @copydoc Decorator::getMetal()
   */
  public function getMetal() {
    return Metal::SILVER;
  }


  /**
   * @copydoc IObserver::getMessages()
   */
  public function getMessages() {
    return ['answer'];
  }


  /**
   * @copydoc IObserver::update()
   * @todo Implements the `update()` method.
   */
  public function update($msg, $data) {

  }

}