<tbody id="tbodyNews">
  @foreach ($newsreports as $report)
  <tr class="table-light">
    <th scope="row">
      <!-- TODO: href -->
      <a href="news_user_doesnt_own.html">{{ $report->title }}</a>
    </th>
    <td>{{ $report->username }}</td>
    <td>{{ $report->newsdate }}</td>
    <td>
      <div class="d-flex flex-column justify-content-between">
        <p>{{$report->numberreports}}</p>
        <a href="all_reports.html">+ Show More</a>
      </div>
    </td>
    <td>{{$report->reportdate}}</td>
    <td>{{$report->description}}</td>
  </tr>
  @endforeach
</tbody>