<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Sastrawi\Stemmer;
use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;
use Auth;
use Validator;
use Exception;
use DB;

use App\Http\Controllers\HomeController;
use App\Models\Tweet;

class TarikTweetController extends Controller
{
  public function index(Request $request)
  {
    $respons = HomeController::$responses;
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');
    if (isset($startDate) && isset($endDate)){
      $result = self::tarikData($respons,$startDate, $endDate);
      $request->session()->flash($result['status'], $result['messages']);
    }
    return view('tarikTweet.index', ['status' => 'NOK']);
  }

  private static function tarikData($respons, $startDate, $endDate)
  {
    
		// dd(str_replace("-","",$startDate) .'0000',str_replace("-","",$endDate) .'2359');
    // $connection = new TwitterOAuth('COzGa5bWLq9vPs7oFgaxbFBkR', 
    //  'ZHijCDDWH920NYQ4tuXpSu56WjjCsln53SOWQslOMZkvfcbF4w', 
    //  '2444378161-tmUHbgrZmUkV6SNyJp0hQRtYYXCmOcCZHBzrYtT', 
    //  '0J7Wc1AFTyXV8HKZnWrnXkEro9w9p2cbHbg5oS8owwkAX');
		
     $connection = new TwitterOAuth('AemNzBdm1eUNOHabKTEd71RU2', 
     'NMTup8ccGrGxyL0tYko0V3mQ7NRVIJmaG1rO95i7PHUlRaL6yB', 
     '1094045109904011264-DrBttGsC7AYeoPIR56Y5csoGWWHn9F', 
     '43JrKjgp56nc1eDjwgMdOzO8UNXQ4UEaPATOpsyRJfQKU');
		
		$accessToken = $connection->oauth2('oauth2/token', array('grant_type' => 'client_credentials'));
    $statuses = $connection->get("tweets/search/fullarchive/development", 
     ["query" => "psbb jakarta",  
      //"tweet_mode" => "extended", 
      "fromDate" => str_replace("-","",$startDate) .'0000', 
      "toDate" => str_replace("-","",$endDate) .'2359']
    );
    
    $sentiment = new SentimentAnalysis();
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $stemmer  = $stemmerFactory->createStemmer();
    DB::beginTransaction();
    try{
      foreach($statuses->results as $row){
        // dd($row->user->profile_image_url);
        if(!isset($row->retweeted_status)){
          isset($row->extended_tweet)
            ? $tweet = $row->extended_tweet->full_text
            : $tweet = $row->text;
  
          $tweet = preg_replace('/[ ](?=[ ])|[^-_@A-Za-z0-9 ]+/', '', $tweet);
          $tweet = preg_replace('/@([\w-]+)/i', '', $tweet); // #tag
          $tweet = preg_replace('/RT|[ ](?=[ ])|[^-_@A-Za-z0-9 ]+/', '', $tweet);
          $tweetRaw = preg_replace('/^\s+|\s+$|\s+(?=\s)|(http\S+)/', '', $tweet);
         
          $output   = $stemmer->stem($tweetRaw);
          
          //Analytics
          $scores = $sentiment->scores($output);
          $decision = $sentiment->decision($output);

          switch($decision){
            case "positive":
              $decision = "Positif";
              break;
            case "neutral":
              $decision ="Netral";
              break;
            case "negative":
              $decision = "Negatif";
              break;
            default:
              $decision = "";
          }

          $params = array(
            'id' => $row->id,
            'date' => date('Y-m-d H:m', strtotime($row->created_at)),
            'raw' => $tweetRaw ?: 'invalid_tweet',
            'text' => $output ?: 'invalid_tweet',
            'ava' => $row->user->profile_image_url ?? null,
            'username' => $row->user->name ?? null,
            'scores' => $scores,
            'decision' => $decision
            );
          self::simpanTweet($params);
        //DB::selectOne('select * from tweet_save(?, ? )', $params);
        } 
      }

      $respons['status'] = "success";
      $respons['messages'] = "Berhasil tarik opini periode ". $startDate . " - " . $endDate;
      
      DB::commit();
    } catch(\Exception $e){
      $respons['status'] = "error";
      $respons['messages'] = "Tidak dapat menarik opini!";
      DB::rollback();
    }
    return $respons;
  }

  private static function simpanTweet($data)
  {
    $cekTweet = Tweet::where('tweettext', $data['text'])->first();
    
    if($cekTweet == null){
      $saveTweet = Tweet::create([
        'tweetcode' => $data['id'],
        'username' => $data['username'],
        'tweetava' => $data['ava'],
        'tweetraw' => $data['raw'],
        'tweettext' => $data['text'],
        'tweetdate' => $data['date'],
        'tweetdecision' => $data['decision'] ?? null,
        'tweetscorepos' => $data['scores']['negative'] ?? null,
        'tweetscorenet' => $data['scores']['neutral'] ?? null,
        'tweetscoreneg' => $data['scores']['positive'] ?? null
      ]);
    }
  }
}
