<script src="{{ asset('js/reports.js') }}" defer></script>
<script src="{{ asset('js/collapsible.js') }}" defer></script>

<div class="container-fluid mt-2">
    <div class="row">
      <!-- TABS -->
      <div class="col-xl-2 col-lg-3 col-12">
        <h3 data-toggle="collapse" data-target="#sections_list" aria-expanded="true" aria-controls="sections_list">
          <i class="fas fa-bars fa-fw"></i> Reports</h3>
        <div class="collapse show collapsible-lg" id="sections_list">
          <ul class="nav nav-pills flex-column left-pane">
            <li class="nav-item">
              <a id="TAB_news" class="nav-link active" data-toggle="tab" href="#news-reports">News</a>
            </li>
            <li class="nav-item">
              <a id="TAB_coms" class="nav-link" data-toggle="tab" href="#comments-reports">Comments</a>
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
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Num. reports
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the last report
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Reasons of the last report</th>
                      </tr>
                    </thead>
                   @include('partials.reports_list')
                  </table>
                </div>
              </div>
              @include('partials.nav_news')
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
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Num. reports
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Date of the last report
                          <i class="fas fa-caret-down fa-fw"></i>
                        </th>
                        <th scope="col" style="width: 16.67%; height: 25%;">Reasons of the last report</th>
                      </tr>
                    </thead>
                    @include('partials.report_list_comment')
                  </table>
                </div>
              </div>

              @include('partials.nav_comments')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>