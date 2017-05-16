<?php

namespace App\Repositories\Comment;

use App\Comment;
use App\Repositories\Repository;

class EloquentComment extends Repository implements CommentRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['content'];

    /**
     * EloquentRole constructor
     *
     * @param Comment $Comment
     */
    public function __construct(Comment $comment)
    {
        parent::__construct($comment, $this->attributes);
    }

}