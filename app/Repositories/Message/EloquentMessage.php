<?php

namespace App\Repositories\Message;

use Auth;
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

    /**
     * get count message read on off
     */
    public function countMessages()
    {      
        $result['count'] = $this->model->where('user_to', Auth::User()->id)
                                       ->where('read_on', false)->count();
        
        return $result;
    }

}