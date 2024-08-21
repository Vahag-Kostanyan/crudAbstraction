<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\MessageBag;

/**
 * @param MessageBag|array|null $errors
 * @param string|null $message
 * @return void
 * @exception HttpResponseException
 */
function validationException(MessageBag|array|null $errors = null, string|null $message = null) : void
{
    throw new HttpResponseException(response()->json([
        'message' => $message ?? 'Validation failed',
        'status' => false,
        'errors' => $errors ?? [],
    ], 422));
}


/**
 * @return void
 * @exception HttpResponseException
 */
function serverException()
{
    throw new HttpResponseException(response()->json([
        'status' => false,
        'errors' => ['Something went wrong, contact support!'],
    ], 500));
}

/**
 * @param string|null $message
 * @return void
 * @exception HttpResponseException
 */
function permissionException(string $message = null)
{
    throw new HttpResponseException(response()->json([
        'status' => false,
        'errors' => [$message ?? 'Permission dinide!']
    ], 403));
}
