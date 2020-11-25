<?php


namespace App\Database;


class Conversation
{
  private $_id;
  private $_idCreator;
  private $_name;

  public function id(){
    return $this->_id;
  }
  public function idCreator() {
    return $this->_idCreator;
  }
  public function name() {
    return $this->_name;
  }
}
