<?php

namespace App\Http\Documentation\Swagger;

interface Auth
{
    /**
     * @OA\Post  (
     *     path="/login",
     *     tags={"Authentication"},
     *     summary="Login",
     *     operationId="auth.login",
     *     description="Login",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="email",
     *                     description="required|email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="required"
     *                 ),
     *                 example={
     *                            "email": "davohambardzumyan@gmail.com",
     *                            "password": "Secret123#"
     *                         }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *     ),
     *     @OA\Response(
     *        response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request"
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="not found"
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity (Validation Error)"
     *     ),
     * )
     */
    function login();

    /**
     * @OA\Get  (
     *     path="/me",
     *     tags={"Authentication"},
     *     summary="Me",
     *     operationId="auth.me",
     *     description="Gets authenticated user",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *     ),
     *     @OA\Response(
     *        response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request"
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="not found"
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity (Validation Error)"
     *     ),
     *     security={{
     *        "apiAuth": {}
     *     }}
     * )
     */
    function me();

    /**
     * @OA\Post  (
     *     path="/logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     operationId="auth.logout",
     *     description="Logout from current device",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *     ),
     *     @OA\Response(
     *        response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request"
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="not found"
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity (Validation Error)"
     *     ),
     *     security={{
     *        "apiAuth": {}
     *     }}
     * )
     */
    function logout();

    /**
     * @OA\Post  (
     *     path="/logout-from-all-devices",
     *     tags={"Authentication"},
     *     summary="Logout from all devices",
     *     operationId="auth.logoutFromAllDevices",
     *     description="Logout from all device",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *     ),
     *     @OA\Response(
     *        response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request"
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="not found"
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Entity (Validation Error)"
     *     ),
     *     security={{
     *        "apiAuth": {}
     *     }}
     * )
     */
    function logoutFromAllDevices();
}
