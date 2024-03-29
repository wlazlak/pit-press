<?php

/**
 * @file ErrorController.php
 * @brief This file contains the ErrorController class.
 * @details
 * @author Filippo F. Fadda
 */


namespace PitPress\Controller;


use Phalcon\Mvc\View;


/**
 * @brief Controller of Error actions.
 * @nosubgrouping
 */
class ErrorController extends BaseController {


  /**
   * @brief 404 Not Found.
   */
  public function show404Action() {
    $this->response->setHeader('HTTP/1.0 404', 'Not Found');
    $this->view->setVar('code', '400');
    $this->view->setVar('title', 'Pagina non trovata');
    $this->view->setVar('message', 'La pagina richiesta non è disponibile. Il link che hai seguito non è funzionante o la pagina è stata rimossa.');
    $this->view->setVar('method', strtolower($_SERVER['REQUEST_METHOD']));
    $this->view->setVar('url', "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
    $this->view->pick('views/error/basic');
  }


  /**
   * @brief 401 Forbidden.
   */
  public function show401Action() {
    $this->response->setHeader('HTTP/1.0 401', 'Forbidden');
    $this->view->setVar('code', '401');
    $this->view->setVar('title', 'Operazione vietata');
    $this->view->setVar('message', "L'operazione richiesta è vietata.");
    $this->view->setVar('method', strtolower($_SERVER['REQUEST_METHOD']));
    $this->view->setVar('url', "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
    $this->view->pick('views/error/basic');
  }
}