<?php

namespace Spartz\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $response = [];

        $status = 400;

        if ($this->isHttpException($e))
        {
            $status = $e->getStatusCode();
        }

        if (config('app.debug'))
        {
            $response['exception'] = get_class($e);
        }

        $response['message'] = empty($e->getMessage()) ? 'There was a problem with your request': $e->getMessage();
        $response['error_code'] = $status;

        return response()->json($response, $status);
    }
}
