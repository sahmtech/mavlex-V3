<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\ModuleUtil;
use App\Utils\Util;

class OtpVerificationController extends Controller
{
         protected $moduleUtil;
         protected $util;
    
    public function __construct(ModuleUtil $moduleUtil, Util $util)
    {
        $this->moduleUtil = $moduleUtil;
        $this->util = $util;
    }
    /**
     * Display OTP verification dashboard
     */
    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('app_settings.otp_verification');
    }

    /**
     * Get OTP data for DataTables
     */
    public function getData(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $filter = $request->get('filter', 'active'); 
        
        if ($filter === 'inactive') {
            $query = User::with(['business'])
                ->whereNull('email_verified_at')
                ->whereDoesntHave('emailTokens', function ($query) {
                    $query->where('status', 'active')
                          ->whereNotNull('otp');
                })
                ->select(['users.*']);
                
            return DataTables::of($query)
                ->addColumn('user_info', function ($row) {
                    $html = '<div class="user-details">';
                    $html .= '<strong>' . $row->first_name . ' ' . $row->last_name . '</strong><br>';
                    $html .= '<small class="text-muted">@' . $row->username . '</small><br>';
                    $html .= '<small class="text-primary">' . $row->email . '</small><br>';
                    $html .= '<small class="text-muted">ID: ' . $row->id . '</small>';
                    $html .= '</div>';
                    return $html;
                })
                ->filterColumn('user_info', function($query, $keyword) {
                    $query->where(function($q) use ($keyword) {
                        $q->where('users.first_name', 'like', "%{$keyword}%")
                          ->orWhere('users.last_name', 'like', "%{$keyword}%")
                          ->orWhere('users.username', 'like', "%{$keyword}%")
                          ->orWhere('users.email', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('business_info', function ($row) {
                    $business = $row->business;
                    if (!$business) return '<span class="text-muted">N/A</span>';
                    
                    $html = '<div class="business-info">';
                    $html .= '<strong>' . $business->name . '</strong><br>';
                    $html .= '<small class="text-muted">ID: ' . $business->id . '</small>';
                    $html .= '</div>';
                    return $html;
                })
                ->filterColumn('business_info', function($query, $keyword) {
                    $query->whereHas('business', function($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('otp_code', function ($row) {
                    return '<span class="text-muted">-</span>';
                })
                ->addColumn('otp_status', function ($row) {
                    return '<span class="badge badge-warning">' . __('settings.no_active_otp') . '</span>';
                })
                ->addColumn('attempts', function ($row) {
                    return '<span class="text-muted">-</span>';
                })
                ->addColumn('resend_count', function ($row) {
                    return '<span class="text-muted">-</span>';
                })
                ->addColumn('created_info', function ($row) {
                    $timezone = session('business.time_zone', config('app.timezone'));
                    $now = Carbon::now($timezone);
                    $created_at = Carbon::parse($row->created_at)->setTimezone($timezone);
                    $updated_at = Carbon::parse($row->updated_at)->setTimezone($timezone);
                    
                    $html = '<div class="created-info">';
                    $html .= '<strong>' . $this->util->format_date($row->created_at, true) . '</strong><br>';
                    $html .= '<small class="text-muted">' . $created_at->diffForHumans() . '</small><br>';
                    $html .= '<small class="text-muted">' . __('settings.updated') . ': ' . $updated_at->diffForHumans() . '</small>';
                    $html .= '</div>';
                    return $html;
                })
                ->addColumn('actions', function ($row) {
                    $html = '<div class="btn-group btn-group-sm" role="group">';
                    $html .= '<button class="btn btn-primary" onclick="manual_verify(' . $row->id . ', \'' . $row->username . '\')" title="' . __('settings.manual_verify_email') . '">';
                    $html .= '<i class="fas fa-check-circle"></i> ' . __('settings.verify');
                    $html .= '</button>';
                    $html .= '</div>';
                    return $html;
                })
                ->rawColumns(['user_info', 'business_info', 'otp_code', 'otp_status', 'attempts', 'resend_count', 'created_info', 'actions'])
                ->make(true);
        }
        
        $query = EmailToken::with(['user', 'user.business'])
            ->whereNotNull('otp')
            ->where('status', 'active')
            ->select([
                'email_tokens.*'
            ]);

        return DataTables::of($query)
            ->addColumn('user_info', function ($row) {
                $user = $row->user;
                if (!$user) return '<span class="text-muted">N/A</span>';
                
                $html = '<div class="user-details">';
                $html .= '<strong>' . $user->first_name . ' ' . $user->last_name . '</strong><br>';
                $html .= '<small class="text-muted">@' . $user->username . '</small><br>';
                $html .= '<small class="text-primary">' . $user->email . '</small><br>';
                $html .= '<small class="text-muted">ID: ' . $user->id . '</small>';
                $html .= '</div>';
                return $html;
            })
            ->filterColumn('user_info', function($query, $keyword) {
                $query->whereHas('user', function($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                      ->orWhere('last_name', 'like', "%{$keyword}%")
                      ->orWhere('username', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('business_info', function ($row) {
                $business = $row->user?->business;
                if (!$business) return '<span class="text-muted">N/A</span>';
                
                $html = '<div class="business-info">';
                $html .= '<strong>' . $business->name . '</strong><br>';
                $html .= '<small class="text-muted">ID: ' . $business->id . '</small>';
                $html .= '</div>';
                return $html;
            })
            ->filterColumn('business_info', function($query, $keyword) {
                $query->whereHas('user.business', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('otp_code', function ($row) {
                $timezone = session('business.time_zone', config('app.timezone'));
                $now = Carbon::now($timezone);
                $expires_at = Carbon::parse($row->otp_expires_at)->setTimezone($timezone);
                $expired = $expires_at->isPast($now);
                $badge_class = $expired ? 'badge-danger' : 'badge-success';
                return '<span class="badge ' . $badge_class . ' font-monospace" style="font-size: 14px;">' . $row->otp . '</span>';
            })
            ->addColumn('otp_status', function ($row) {
                $timezone = session('business.time_zone', config('app.timezone'));
                $now = Carbon::now($timezone);
                $expires_at = Carbon::parse($row->otp_expires_at)->setTimezone($timezone);
             
                
                if ($expires_at->isPast($now)) {
                    $html = '<span class="badge badge-danger">' . __('settings.expired') . '</span>';
                } else {
                    $time_left_seconds = $now->diffInSeconds($expires_at);
                    $time_left_minutes = intval($time_left_seconds / 60);
                    $remaining_seconds = $time_left_seconds % 60;
                    
                    $html = '<span class="badge badge-success">' . __('settings.active') . '</span>';
                    $html .= '<br><small class="text-warning">' . __('settings.expires_in') . ' ' . $time_left_minutes . ':' . str_pad($remaining_seconds, 2, '0', STR_PAD_LEFT) . '</small>';
                }
                
                return $html;
            })
            ->addColumn('attempts', function ($row) {
                $attempts_class = $row->otp_attempts >= 3 ? 'text-danger' : 
                                ($row->otp_attempts >= 2 ? 'text-warning' : 'text-success');
                $remaining_attempts = max(0, 3 - $row->otp_attempts);
                
                $html = '<span class="' . $attempts_class . '">';
                $html .= $row->otp_attempts . '/3 ' . __('settings.attempts');
                $html .= '</span><br>';
                $html .= '<small class="text-muted">' . $remaining_attempts . ' ' . __('settings.remaining') . '</small>';
                
                return $html;
            })
            ->addColumn('resend_count', function ($row) {
                $resend_class = $row->resend_count >= 3 ? 'text-danger' : 
                              ($row->resend_count >= 2 ? 'text-warning' : 'text-info');
                
                $html = '<span class="' . $resend_class . '">' . $row->resend_count . ' ' . __('settings.resends') . '</span>';
                
                if ($row->last_resend_at) {
                    $html .= '<br><small class="text-muted">' . __('settings.last') . ': ' . $row->last_resend_at->format('H:i:s') . '</small>';
                }
                
                return $html;
            })
            ->addColumn('created_info', function ($row) {
                $app_timezone = config('app.timezone');
                $session_timezone = session('business.time_zone');
                $timezone = session('business.time_zone', config('app.timezone'));
                
               
                $now = Carbon::now($timezone);
                $created_at = Carbon::parse($row->created_at)->setTimezone($timezone);
                $updated_at = Carbon::parse($row->updated_at)->setTimezone($timezone);
                
                $html = '<div class="created-info">';
                $html .= '<strong>' . $this->util->format_date($row->created_at, true) . '</strong><br>';
                $html .= '<small class="text-muted">' . $created_at->diffForHumans() . '</small><br>';
                $html .= '<small class="text-muted">' . __('settings.updated') . ': ' . $updated_at->diffForHumans() . '</small>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('actions', function ($row) {
                $html = '<div class="btn-group btn-group-sm" role="group">';
                
                $html .= '<button class="btn btn-warning" onclick="reset_otp(' . $row->id . ')" title="' . __('settings.reset_otp') . '">';
                $html .= '<i class="fas fa-redo"></i>';
                $html .= '</button>';
                
                $html .= '<button class="btn btn-success" onclick="manual_verify(' . $row->user_id . ', \'' . ($row->user->username ?? '') . '\')" title="' . __('settings.manual_verify') . '">';
                $html .= '<i class="fas fa-check"></i>';
                $html .= '</button>';
                
                $html .= '<button class="btn btn-danger" onclick="deactivate_token(' . $row->id . ')" title="' . __('settings.deactivate') . '">';
                $html .= '<i class="fas fa-times"></i>';
                $html .= '</button>';
                
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['user_info', 'business_info', 'otp_code', 'otp_status', 'attempts', 'resend_count', 'created_info', 'actions'])
            ->make(true);
    }

    /**
     * Reset OTP for a user
     */
    public function resetOtp(Request $request)
    {
          if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
         $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
        $request->validate([
            'token_id' => 'required|exists:email_tokens,id'
        ]);

        $emailToken = EmailToken::findOrFail($request->token_id);
        
        // Clear OTP and reset counters
        $emailToken->clearOtp();
        $emailToken->resend_count = 0;
        $emailToken->last_resend_at = null;
        $emailToken->save();

        return response()->json([
            'success' => true,
            'message' => 'OTP reset successfully'
        ]);
    }

    /**
     * Manually verify email for user
     */
    public function manualVerify(Request $request)
    {
          if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
         $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Verify the user's email
        $user->email_verified_at = now();
        $user->save();

        // Deactivate all tokens for this user
        EmailToken::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'inactive']);

        return response()->json([
            'success' => true,
            'message' => 'Email verified manually for user: ' . $user->username
        ]);
    }

    /**
     * Delete/Deactivate OTP token
     */
    public function deactivateToken(Request $request)
    {
          if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
         $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
        $request->validate([
            'token_id' => 'required|exists:email_tokens,id'
        ]);

        $emailToken = EmailToken::findOrFail($request->token_id);
        $emailToken->status = 'inactive';
        $emailToken->save();

        return response()->json([
            'success' => true,
            'message' => 'OTP token deactivated'
        ]);
    }

    /**
     * Get statistics for dashboard
     */
    public function getStats()
    {
          if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $stats = [
            'active_otps' => EmailToken::whereNotNull('otp')
                ->where('status', 'active')
                ->count(),
            
            'expired_otps' => EmailToken::whereNotNull('otp')
                ->where('status', 'active')
                ->where('otp_expires_at', '<', now())
                ->count(),
                
            'failed_attempts' => EmailToken::whereNotNull('otp')
                ->where('status', 'active')
                ->where('otp_attempts', '>=', 3)
                ->count(),
                
            'pending_verification' => User::whereNull('email_verified_at')
                ->count(),
                
            'today_requests' => EmailToken::whereDate('created_at', today())
                ->count(),
                
            'high_retry_users' => EmailToken::where('resend_count', '>=', 3)
                ->where('status', 'active')
                ->count()
        ];

        return response()->json($stats);
    }
}