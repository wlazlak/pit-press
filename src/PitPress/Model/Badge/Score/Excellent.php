<?php

/**
 * @file Excellent.php
 * @brief This file contains the Excellent class.
 * @details
 * @author Filippo F. Fadda
 */


namespace PitPress\Model\Badge;


/**
 * @brief Wrote a post with 15 score.
 * @details Awarded multiple times.
 */
class Excellent extends Silver {


  /**
   * @copydoc Badge::getName()
   */
  public function getName() {
    return "Eccellente";
  }


  /**
   * @copydoc Badge::getBrief()
   */
  public function getBrief() {
    return "Primo a rispondere ad una domanda; risposta accetatta con punteggio di 10.";
  }


  /**
   * @copydoc Badge::getDetails()
   */
  public function getDetails() {
    return <<<'DESC'
Sei la prima persona a rispondere ad una domanda e totalizzare un punteggio pari a 10 per la risposta. Quest'ultima deve
essere accettata dall'autore della domanda. Il badge viene assegnato soltanto nel caso in cui l'autore della domanda non
risponda alla sua stessa domanda. Assegnato più volte.
DESC;
  }


  /**
   * @copydoc Badge::award()
   */
  public function award() {

  }


  /**
   * @copydoc Badge::withdrawn()
   */
  public function withdrawn() {

  }

} 