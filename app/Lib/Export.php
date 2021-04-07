<?php
namespace App\Lib;

use App\Models\Tweet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Export implements FromView
{
  public function __construct($startDate, $endDate, $data)
  {
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->data = $data;
  }

  public function view(): View
  {
    return view('exports.tweet', [
      'tweets' => $this->data
    ]);
  }
}