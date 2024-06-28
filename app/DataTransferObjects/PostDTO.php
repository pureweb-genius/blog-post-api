<?php

namespace App\DataTransferObjects;

class PostDTO
{
    public $title;
    public $body;


  public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }
}