<?php

namespace Modules\Zatca\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Zatca\Zatca;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RenewSettingsController extends Controller
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

            return response()->json(Zatca::renewZatcaSetting($request->input('otp'), (object) $request->input('settings')));
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
                'settings.cnf' => 'required',
                'settings.private_key' => 'required',
                'settings.public_key' => 'required',
                'settings.csr' => 'required',
                'settings.cert_production' => 'required',
                'settings.secret_production' => 'required',
                'settings.csid_id_production' => 'required',
                'settings.cert_compliance' => 'required',
                'settings.secret_compliance' => 'required',
                'settings.csid_id_compliance' => 'required',
            ]
        );
    }
}
