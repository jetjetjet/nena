<table>
  <thead>
  <tr>
    <th>Username</th>
    <th>Tgl</th>
    <th>Tweet</th>
    <th>Skor_Positif</th>
    <th>Skor_Netral</th>
    <th>Skor_Negatif</th>
    <th>Sentimen</th>
  </tr>
  </thead>
  <tbody>
  @foreach($tweets as $tw)
    <tr>
      <td>{{ $tw->username }}</td>
      <td>{{ $tw->tweetdate }}</td>
      <td>{{ $tw->tweettext }}</td>
      <td>{{ $tw->tweetscorepos }}</td>
      <td>{{ $tw->tweetscorenet }}</td>
      <td>{{ $tw->tweetscoreneg }}</td>
      <td>{{ $tw->tweetdecision }}</td>
    </tr>
  @endforeach
  </tbody>
</table>