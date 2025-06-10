<?php

namespace App\Http\Controllers;

use App\Models\TextWidget;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteController extends Controller
{
    public function about() {
        $widget = TextWidget::where('active', true)
            ->where('key', '=', 'about-us-page-widget')
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('about', compact('widget'));
    }
}
