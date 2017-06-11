<?php

namespace App\Repositories\Message;

use App\Repositories\RepositoryInterface;

interface MessageRepository extends RepositoryInterface
{
    /**
     * get count message read on off
     */
    public function countMessages();
}