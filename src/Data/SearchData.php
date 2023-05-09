<?php

namespace App\Data;

class SearchData
{
  /**
   * @var string
   */

  public $q = '';

  /**
   * @var Category[]
   */

  public $categories = [];

  /**
   * @var Reservation[]
   */

   public $reservations = [];

   /**
    * @var Username[]
    */
  public $username = [];

  /**
   * @var int
   */

  public $page = 1;

}