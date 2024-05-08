<?php

namespace Cms\Base\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errorNumber, $errorMessage)
    {
        return response()->json([
            'status' => false,
            'number' => $errorNumber,
            'message' => $errorMessage
        ]);
    }

    public function returnSuccessMessage($successMessage, $successNumber = 1)
    {
        return response()->json([
            'status' => true,
            'number' => $successNumber,
            'message' => $successMessage
        ]);
    }

    public function returnSuccess($successNumber = 200, $successMessage = "")
    {
        return [
            'status' => true,
            'number' => $successNumber,
            'message' => $successMessage
        ];
    }

    public function returnData($key, $value, $message = "")
    {
        // return [
        //     "$key" => $value,
        //    'message' => $message
        // ];
        return response()->json([
            'status' => true,
            'message' => $message,
            $key => $value
        ]);
    }

    public function returnValidationError($code = "EOO1", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }

    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name") {
            return "E001";
        } elseif ($input == "email") {
            return "E002";
        } elseif ($input == "phone") {
            return "E003";
        } elseif ($input == "password") {
            return "E004";
        } elseif ($input == "level_id") {
            return "E005";
        } elseif ($input == "package_id") {
            return "E006";
        } elseif ($input == "otp") {
            return "E007";
        } elseif ($input == "device_token") {
            return "E008";
        } elseif ($input == "order_id") {
            return "E009";
        } elseif ($input == "old_password") {
            return "E010";
        }
    }
}
