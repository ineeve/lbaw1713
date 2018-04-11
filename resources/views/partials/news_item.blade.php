
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="article">
      <div class="container-fluid">
        <div class="row">
          <!-- ARTICLE OPTIONS -->
          <div class="col-1 pr-0">
            <div class="d-flex mt-5 justify-content-end">
              <div class="position-relative mr-2 mt-1 d-flex flex-column justify-content-between align-items-end">
                <span> {{ $news->votes }}</span>
                <span class="position-absolute" style="bottom: -4px;">Report</span>
              </div>
              <div class="d-flex flex-column article-options">
                <i class="fas fa-arrow-alt-circle-up clickable-btn"></i>
                <i class="fas fa-arrow-alt-circle-down mt-2 clickable-btn"></i>
                <i class="fas fa-ban mt-2 clickable-btn" data-toggle="modal" data-target="#reportModal"></i>
                <!-- Report -->
              </div>
            </div>
          </div>
          <!-- ARTICLE -->
          <div class="col-11 col-lg-10 mt-3 article">
            <h6 class="category"> {{ $news->section }}</h6>
              <h2 class="title"> {{ $news->title }}</h2>
              <h6 class="author"> {{ $news->author }} &middot; {{ $news->date }}</h6>
              <img class="img-fluid mx-auto my-3 d-block" src="{{ asset('img/'.$news->image) }}" alt="TODO ADD "
               width="460" height="345">
              <div class="body">
                  {{ $news->body }}
              </div>
              <h4>Source</h4>
              <!-- TODO: add sources -->
              <a href="https://www.buzzfeed.com/davidmack/fox-news-deletes-anti-diversity-winter-olympics-op-ed?utm_term=.pbarWObP7#.tdkAg8ZlJ">BuzzFeedNews</a>
              <h3 class="mt-4">Comments</h3>
              <form class="mt-3 mb-4">
                <div class="form-group">
                  <textarea class="form-control" id="self-comment" rows="3" placeholder="Comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
              </form>
              <!-- TODO: add comments -->
              <div class="row">
                <div class="col">
                  <a href="#" class="loadMore" style="text-decoration: none;">Show More</a>
                </div>
                <div class="col text-right">
                  <p class="totop">
                    <a style="text-decoration: none;" href="#top">Back to top</a>
                  </p>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
