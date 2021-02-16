<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sastrawi\Stemmer;
use Validator;
use Exception;
use DB;
use DataTables;

use App\Http\Controllers\HomeController;
use App\Models\Tweet;
use App\Models\Analytic;
use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;

class AnalyticController extends Controller
{
  public function index()
  {
    return view('Analytic.index');
  }

  public function getLists(Request $request)
  {
    return Datatables::of(Tweet::all())->make(true);
  }
}
