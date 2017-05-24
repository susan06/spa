<?php

namespace App\Repositories\Message;

use App\Message;
use App\Repositories\Repository;

class EloquentMessage extends Repository implements MessageRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentRole constructor
     *
     * @param Message $Message
     */
    public function __construct(Message $message)
    {
        parent::__construct($message, $this->attributes);
    }

}