<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Export;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tweet;

class ExportController extends Controller
{
	public function index(Request $request)
	{
		return view('exports.index');
	}

	public function export(Request $request)
	{
		$startDate = $request->input('startDate');
    $endDate = $request->input('endDate');
		$q = Tweet::whereRaw("tweetdate::date between '" . $startDate . "'::date and '" . $endDate . "'::date")
      ->select(
        'username',
        'tweetraw',
        'tweettext',
        'tweetdate',
        'tweetdecision',
        'tweetscorepos',
        'tweetscorenet',
        'tweetscoreneg'
      )->orderBy('tweetdate', 'ASC')
      ->get();
		if($q->isNotEmpty()){
			return Excel::download(new Export($startDate, $endDate, $q), 'hasilSentimen.xlsx', \Maatwebsite\Excel\Excel::XLSX);
			// return (new Export($startDate, $endDate))->download('hasilSentimen.csv', Excel::CSV);
		} else {
			$request->session()->flash("error", "Data tidak ditemukan pada tanggal tersebut!");
			return view('exports.index');
		}
	}
}
