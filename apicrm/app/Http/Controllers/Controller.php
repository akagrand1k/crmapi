<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function json($data)
    {
        return [
            'success' => true,
            'data' => $data
        ];
    }
     /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function sendResponse($result, $message='')
  {
    $response = [
          'success' => true,
          'data'    => $result,
          'message' => $message,
      ];
      return response()->json($response, 200);
  }
  /**
   * return error response.
   *
   * @return \Illuminate\Http\Response
   */
  public function error($error, $errorData = [], $code = 404)
  {
      /*
    throw new HttpResponseException(response()->json([
        'errors' => $errors
    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));*/
    $response = [
          'success' => false,
          'message' => $error,
      ];
      if(!empty($errorData)){
          $response['data'] = $errorData;
      }
      return response()->json($response, $code);
  }

  public function sendError($error, $errorData = [], $code = 404)
  {
      /*
    throw new HttpResponseException(response()->json([
        'errors' => $errors
    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));*/
    $response = [
          'success' => false,
          'message' => $error,
      ];
      if(!empty($errorData)){
          $response['data'] = $errorData;
      }
      return response()->json($response, $code);
  }
}
