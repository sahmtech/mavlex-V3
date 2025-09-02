<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;

class Language
{
public function handle($request, Closure $next)
{
    $locale = config('app.locale'); 
    $textDirection = 'ltr'; 

    if (Auth::check()) {
        $userLanguage = Auth::user()->language;
        if (!empty($userLanguage)) {
            $locale = $userLanguage;
            $textDirection = $this->getTextDirection($userLanguage);
        }
    } elseif ($request->session()->has('user.language')) {
        $locale = $request->session()->get('user.language');
        $textDirection = $this->getTextDirection($locale);
    }

    App::setLocale($locale);
    $request->session()->put('user.language', $locale); 
    $request->session()->put('textDirection', $textDirection);

    return $next($request);
}

protected function getTextDirection($language)
{
    $rtlLanguages = config('constants.langs_rtl', ['ar']);
    return in_array($language, $rtlLanguages) ? 'rtl' : 'ltr';
}

}
