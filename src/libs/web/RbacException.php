<?php
namespace kordar\ace\web;

use yii\base\UserException;

class RbacException extends UserException
{
    /**
     * @var int HTTP status code, such as 403, 404, 500, etc.
     */
    public $statusCode;

    public static $rbacStatuses = [
        2200 => 'rbac error',
    ];

    /**
     * Constructor.
     * @param int $status HTTP status code, such as 404, 500, etc.
     * @param string $message error message
     * @param int $code error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($status, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct($message, $status, $previous);
    }

    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        if (isset(RbacException::$rbacStatuses[$this->statusCode])) {
            return RbacException::$rbacStatuses[$this->statusCode];
        } else {
            return 'Error';
        }
    }
}