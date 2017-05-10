<?php

namespace App\Support\Logger;

use Activity;
use Auth;
use Illuminate\Database\Eloquent\Model;

trait LoggerTrait
{
    /**
     * LogAction
     * 
     * register a new action on the log.
     *
     * @param $message
     * @param $modelArray
     *
     */
    public function logAction($action = null, $message = null, $model = null, $modelId = null, $details = null)
    {

        $activity = Activity::log([
            'contentId'   => $modelId,
            'contentType' => $model,
            'action'      => $action,
            'description' => $message,
            'details'     => $details
        ]);

        return $activity;
    }
}
