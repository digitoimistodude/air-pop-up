<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Pop_Up_Location extends ACF_Location {

  public function initialize() {
    $this->name = 'air-pop-up-additional-fields';
    $this->label = 'Air Pop up additional fields';
    $this->category = 'post';
    $this->object_type = 'post';
  }
}
