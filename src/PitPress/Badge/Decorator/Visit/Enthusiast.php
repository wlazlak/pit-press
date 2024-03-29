<?php

/**
 * @file Enthusiast.php
 * @brief This file contains the Enthusiast class.
 * @details
 * @author Filippo F. Fadda
 */


namespace PitPress\Badge\Decorator\Visit;


use PitPress\Badge\Decorator\Decorator;
use PitPress\Enum\Metal;


/**
 * @brief Visited the site each day for 30 consecutive days.
 * @details Awarded once.
 * @nosubgrouping
 */
class Enthusiast extends Decorator {


  /**
   * @copydoc Decorator::getName()
   */
  public function getName() {
    return "Entusiasta";
  }


  /**
   * @copydoc Decorator::getBrief()
   */
  public function getBrief() {
    return <<<'DESC'
Hai visitato il sito per 30 giorni consecutivi. Assegnato una sola volta.
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
    return ['time'];
  }


  /**
   * @copydoc IObserver::update()
   * @todo Implements the `update()` method.
   */
  public function update($msg, $data) {

  }

}