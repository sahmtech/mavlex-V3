<?php

namespace Modules\Zatca\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Zatca\Helpers\ConfigHelper;
use Modules\Zatca\Classes\Objects\Setting;
use Modules\Zatca\Zatca;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $this->handleValidation($request);

            $settings = new Setting(
                $request->input('otp'),
                $request->input('emailAddress'),
                $request->input('commonName'),
                $request->input('organizationalUnitName'),
                $request->input('organizationName'),
                $request->input('taxNumber'),
                $request->input('registeredAddress'),
                $request->input('businessCategory'),
                $request->input('egsSerialNumber'),
                $request->input('registrationNumber'),
                $request->input('invoiceType')
            );

            return response()->json(Zatca::generateZatcaSetting($settings));
        }
        catch(Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    private function handleValidation(Request $request)
    {
        $this->validate(
            $request, 
            [
                'otp' => 'required',
                'emailAddress' => 'required',
                'commonName' => 'required',
                'organizationalUnitName' => 'required',
                'organizationName' => 'required',
                'taxNumber' => 'required',
                'registeredAddress' => 'required',
                'businessCategory' => 'required',
                'registrationNumber' => 'required',
                'invoiceType' => 'required|in:0100,1000,1100',
                'egsSerialNumber' => 'nullable',
            ], 
            [
                'invoiceType.in' => [
                    'message' => 'validation.in',
                    'SIMPLIFIED' => '0100',
                    'STANDARD' => '1000',
                    'BOTH' => '1100',
                ],
            ]
        );
    }
}
