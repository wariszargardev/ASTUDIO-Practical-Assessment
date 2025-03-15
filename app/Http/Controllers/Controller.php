<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // we can use separate class for constants but for simplicity we are using this class

    // Status Code
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    // Status Keyword
    public const SUCCESS_STATUS = 'success';
    public const ERROR_STATUS = 'error';

    // MESSAGE
    public const SUCCESS_MESSAGE = 'Request completed successfully';
    public const ERROR_MESSAGE = 'An error occurred while processing your request';
    public const NOT_FOUND_MESSAGE = 'Resource not found';
    public const UNAUTHORIZED_MESSAGE = 'Unauthorized access';
    public const LOGOUT_MESSAGE = 'User logged out successfully';

}
