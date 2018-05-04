<script src="{{ asset('js/reports.js') }}" defer></script>

<div class="container-fluid mt-2">
    <div class="row">
      <!-- TABS -->
      <div class="col-xl-2 col-lg-3 col-12">
        <h3 data-toggle="collapse" data-target="#sections_list" aria-expanded="true" aria-controls="sections_list">
          <i class="fas fa-bars"></i> Reports</h3>
        <div class="collapse" id="sections_list">
        <!-- TODO: Alterar vista -->
          <ul class="nav nav-pills flex-column left-pane">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#news-reports">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#comments-reports">Comments</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- MAIN CONTENT -->
      <div class="col-xl-10 col-lg-9 col-12">
        <div id="myTabContent" class="tab-content">
          <!-- NEWS' REPORTS TAB -->
          <div class="tab-pane fade active show" id="news-reports">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-12">
                  <h1>News Reports</h1>
                </div>
              </div>

              <!-- TABELA/ SEGUNDA LINHA -->
              <div class="row mt-2">
                <!-- MID COLUMN (TABLE)-->
                <div class="col-12">
                  <table class="table table-hover table-responsive">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 16.67%; height: 25%;">News Title</th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Author of the news</th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the posting
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Num. reports
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the last report
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Reasons of the last report</th>
                      </tr>
                    </thead>
                   @include('partials.reports_list')
                  </table>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="col-centered">
                    <ul class="pagination pagination-sm">
                      <li id="p" class="page-item disabled">
                        <a  class="page-link" href="#" onClick="getPreviousArticles(event);">&laquo;</a>
                      </li>
                      <li id="n" class="page-item">
                        <a  class="page-link" href="#" onClick="getNextArticles(event);">&raquo;</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- COMMENTS' REPORTS TAB -->
          <div class="tab-pane fade" id="comments-reports">
            <div class="container-fluid">
              <div class="row my-2">
                <div class="col-12">
                  <h1>Comment Reports</h1>
                </div>
              </div>

              <!-- TABELA/ SEGUNDA LINHA -->
              <div class="row mt-2">
                <!-- MID COLUMN (TABLE)-->
                <div class="col-12">
                  <table class="table table-hover table-responsive">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 16.67%; height: 25%;">Comment ID</th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Author of the comment</th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the posting
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Num. reports
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the last report
                          <i class="fas fa-caret-down"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Reasons of the last report</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-light">
                        <th scope="row" style="width: 16.67%; height: 25%;">
                          <a href="#">#6643</a>
                        </th>
                        <td style="width: 16.67%; height: 25%;">Mark</td>
                        <td style="width: 16.67%; height: 25%;">12:25 23/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">
                          <div class="d-flex flex-column justify-content-between">
                            <p>20</p>
                            <a href="all_reports.html">+ Show More</a>
                          </div>
                        </td>
                        <td style="width: 16.67%; height: 25%;">15:31 26/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">Has violent or prohibited content
                          <br>It's offensive
                          <br>I do not agree with this</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row" style="width: 16.67%; height: 25%;">
                          <a href="#">#15</a>
                        </th>
                        <td style="width: 16.67%; height: 25%;">Dylan</td>
                        <td style="width: 16.67%; height: 25%;">12:25 23/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">
                          <div class="d-flex flex-column justify-content-between">
                            <p>10</p>
                            <a href="all_reports.html">+ Show More</a>
                          </div>
                        </td>
                        <td style="width: 16.67%; height: 25%;">15:31 26/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">It's spam</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row" style="width: 16.67%; height: 25%;">
                          <a href="#">#189</a>
                        </th>
                        <td style="width: 16.67%; height: 25%;">David</td>
                        <td style="width: 16.67%; height: 25%;">12:25 23/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">
                          <div class="d-flex flex-column justify-content-between">
                            <p>6</p>
                            <a href="all_reports.html">+ Show More</a>
                          </div>
                        </td>
                        <td style="width: 16.67%; height: 25%;">15:31 26/02/2018</td>
                        <td style="width: 16.67%; height: 25%;">Is sexually inappropriate</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="col-centered">
                    <ul class="pagination pagination-sm">
                      <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">&raquo;</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>