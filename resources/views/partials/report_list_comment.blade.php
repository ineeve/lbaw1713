<tbody id="tbodyComments">
@foreach ($commentreports as $report)
   <tr class="table-light">
        <th scope="row" style="width: 16.67%; height: 25%;">
            <a href="/news/{{$report->news_id}}#commentNo{{ $report->commentid }}">{{ $report->commentid }}</a>
        </th>
        <td style="width: 16.67%; height: 25%;">{{ $report->username }}</td>
        <td style="width: 16.67%; height: 25%;">{{ $report->commentdate }}</td>
        <td style="width: 16.67%; height: 25%;">
            <div class="d-flex flex-column justify-content-between">
                <p>{{$report->numberreports}}</p>
                <a href="/reports/{{$report->id}}">+ Show More</a>
            </div>
        </td>
        <td style="width: 16.67%; height: 25%;">{{$report->reportdate}}</td>
        <td style="width: 16.67%; height: 25%;">{{$report->description}}</td>
        </tr>
        @endforeach
</tbody>