<tbody id="tbodyNews">
  @foreach ($newsreports as $report)
  <tr class="table-light">
    <th scope="row">
      <a href="/news/{{$report->news_id}}">{{ $report->title }}</a>
    </th>
    <td>{{ $report->username }}</td>
    <td>{{ date("F jS, Y \a\\t H:i", strtotime($report->newsdate)) }}</td>
    <td>
      <div class="d-flex flex-column justify-content-between">
        <p>{{$report->numberreports}}</p>
        <a href="/reports/{{$report->id}}">+ Show More</a>
      </div>
    </td>
    <td>{{ date("F jS, Y \a\\t H:i", strtotime($report->reportdate)) }}</td>
    <td>{{$report->description}}</td>
  </tr>
  @endforeach
</tbody>