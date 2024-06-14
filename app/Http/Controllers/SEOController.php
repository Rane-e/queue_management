<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Auth;

class SEOController extends Controller
{
    public function index()
    {
        // Установка SEO мета-тегов
        SEOMeta::setTitle('Очередь');
        SEOMeta::setDescription('Страница с очередью');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Очередь');
        OpenGraph::setDescription('Страница с очередью');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');

        $userName = Auth::check() ? Auth::user()->name : null;
        $subjects = Subject::all();
        return view('subjects.index', compact('userName', 'subjects'));
    }
}
