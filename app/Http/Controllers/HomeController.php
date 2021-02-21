<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tweet;
use DB;

class HomeController extends Controller
{
  public static $responses = array('status' => "", 'messages' => "");

  public function index(Request $request)
  {
    $data = new \StdClass();
    $chart = self::getChartValue();
    $neg = [];
    $net = [];
    $pos = [];
    $bln = [];
    foreach($chart as $c){
      array_push($neg, $c->neg);
      array_push($net, $c->net);
      array_push($pos, $c->pos);
      array_push($bln, self::getBlnThn($c->month, $c->year));
    }

    $data->chartNegatif = implode(',', $neg);
    $data->chartNetral = implode(',', $net);
    $data->chartPositif = implode(',', $pos);
    $data->chartBulan = implode(",", $bln);
    $data->card = self::cardSentimen();
    return view('dashboard.index')->with('data', $data);
  }

  private static function getBlnThn($bln, $thn)
  {
    $blnValue = "";
    switch ($bln) {
      case "01":
        $blnValue = 'Januari ' . $thn;
        break;
      case "02":
        $blnValue = 'Februari ' . $thn;
        break;
      case "03":
        $blnValue = 'Maret ' . $thn;
        break;
      case "04":
        $blnValue = 'April ' . $thn;
        break;
      case "05":
        $blnValue = 'Mei ' . $thn;
        break;
      case "06":
        $blnValue = 'Juni ' . $thn;
        break;
      case "07":
        $blnValue = 'Juli ' . $thn;
        break;
      case "08":
        $blnValue = 'Agustus ' . $thn;
        break;
      case "09":
        $blnValue = 'September ' . $thn;
        break;
      case "10":
        $blnValue = 'Oktober ' . $thn;
        break;
      case "11":
        $blnValue = 'November ' . $thn;
        break;
      case "12":
        $blnValue = 'Desember ' . $thn;
        break;
      default:
        break;
    }
    return $blnValue;
  }

  public function getDataDash(Request $request)
  {
    $bln = isset($request->bulan) ? $request->bulan : Carbon::now()->format('m');
    $thn = isset($request->tahun) ? $request->tahun : Carbon::now()->format('Y');
    $filter = $thn . '-' . $bln;
    $parse = Carbon::parse($filter);$array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
    
    
    $dataChart = new \StdClass();
    $chart = self::getChartValue();
    $dataChart->chart = array();
    $blnNow = Carbon::now()->format('m');
    $bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    foreach($bln as $key  => $val){
      $anka = $key + 1;
      foreach($chart as $c){
        $temp = new \StdClass();
        $temp->bln = $val;
        $temp->valPos = 0 . $anka == $c->month ? $c->pos:0;
        $temp->valNet = 0 . $anka == $c->month ? $c->net:0;
        $temp->valNeg = 0 . $anka == $c->month ? $c->neg:0;
        array_push($dataChart->chart, $temp);
      }
    }
    dd($dataChart);
    $card = self::cardSentimen();
    return view('dashboard.index')
      ->with('card', $card);
  }

  private static function getChartValue()
  {
    $q = DB::table('tweets')
        ->joinSub(self::subChart('Positif'), 'pos', function ($join) {
          $join->on(DB::raw("DATE_TRUNC('month',tweetdate::date)::date"), '=', 'pos.month');})
        ->joinSub(self::subChart('Netral'), 'net', function ($join) {
          $join->on(DB::raw("DATE_TRUNC('month',tweetdate::date)::date"), '=', 'net.month');})
        ->joinSub(self::subChart('Negatif'), 'neg', function ($join) {
          $join->on(DB::raw("DATE_TRUNC('month',tweetdate::date)::date"), '=', 'neg.month');})
        // ->where('tweetdate', 'LIKE', '%' . $filter . '%')
        ->groupByRaw("DATE_TRUNC('month',tweetdate::date)::date, pos.sentimen, net.sentimen, neg.sentimen, to_char(tweetdate, 'YYYY')")
        ->selectRaw(DB::raw("to_char(DATE_TRUNC('month',tweetdate::date)::date, 'MM') as month, to_char(tweetdate, 'YYYY') as year, pos.sentimen as pos, net.sentimen as net, neg.sentimen as neg"))
        ->get();
    return $q;
  }

  private static function subChart($filter)
  {
    return DB::table('tweets')
      ->selectRaw("DATE_TRUNC('month',tweetdate::date)::date as month, sum(1) as sentimen")
      ->where('tweetdecision', $filter)
      ->groupByRaw("DATE_TRUNC('month',tweetdate::date)::date");
  }

  private static function cardSentimen()
  {
    $positif = Tweet::where('tweetdecision', 'Positif')->count();
    $netral = Tweet::where('tweetdecision', 'Netral')->count();
    $negatif = Tweet::where('tweetdecision', 'Negatif')->count();
    $total = Tweet::count();

    $data = Array(
      'totalPositif' => $positif ?? 'error!',
      'totalNetral' => $netral ?? 'error!',
      'totalNegatif' => $negatif ?? 'error!',
      'totalTweet' => $total ?? 'error!'
    );

    return $data;
  }
}
