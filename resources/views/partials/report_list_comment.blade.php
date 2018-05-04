<tbody id="tbodyComments">
@foreach ($commentreports as $report)
   {{print_r($report)}}
   <tr class="table-light">
        <th scope="row" style="width: 16.67%; height: 25%;">
             <!-- TODO: href -->
            <a href="#">{{ $report->commentid }}</a>
        </th>
        <td style="width: 16.67%; height: 25%;">{{ $report->username }}</td>
        <td style="width: 16.67%; height: 25%;">{{ $report->commentdate }}</td>
        <td style="width: 16.67%; height: 25%;">
            <div class="d-flex flex-column justify-content-between">
                <p>{{$report->numberreports}}</p>
                <a href="all_reports.html">+ Show More</a>
            </div>
        </td>
        <td style="width: 16.67%; height: 25%;">{{$report->reportdate}}</td>
        <td style="width: 16.67%; height: 25%;">{{$report->description}}</td>
        </tr>
        @endforeach
</tbody>