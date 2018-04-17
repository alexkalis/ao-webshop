<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
      $title = 'Home';
      return view('pages.index', compact('title'));
    }

    public function about() {
      $title = 'Info';
      return view('pages.about', compact('title'));
    }
    public function contact() {
      $title = 'Contact';
      return view('pages.contact', compact('title'));
    }
}
