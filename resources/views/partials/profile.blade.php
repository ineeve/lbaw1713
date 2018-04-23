  <div class="container-fluid">

    <div class="row">

      <div class="row col-lg-3 col-12 mx-0">

        <div class="border border-top-0 border-left-0 border-right-0 col-4 col-lg-12 profile_item container p-2 mx-auto mt-3">


          <div class="row">
            <div clas="col">
              <a href="profile_edit.html">

                <div class="ml-3 mt-1 d-flex flex-row align-items-center">
                  <i class="fa fa-edit"></i>
                  <h5 class="ml-2 mt-2">Edit Profile</h5>
                </div>
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <img class="img-responsive" src="https://c1.staticflickr.com/3/2936/14387367072_85312c31b3_b.jpg" alt="pic" height="200px"
                width="200px">
            </div>

          </div>

          <div class="row">

            <div class="col">

              <h4 class="font-weight-bold mt-2">{{ $user->username }}</h4>
              <h4>
                <span class="badge badge-secondary">{{ $user->points }} points</span>
              </h4>
              <p class="mb-0">{{ $user->gender }}
              </p>
              <p class="mb-0">{{ $user->country }}
              </p>
              <p class="mb-0">{{ $user->email }}
              </p>

            </div>
          </div>

        </div>
        <div class="col-6 col-lg-12 p-2 mt-3">

          <h3>Last badges earned
            <span class="badge badge-secondary">10/25</span>
          </h3>
          <!-- Badges Modal -->
          <div class="modal fade" id="badgesModal" tabindex="-1" role="dialog" aria-labelledby="badgesModalLabel" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="badgesModalLabel">All Badges</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body d-flex justify-content-around flex-wrap" style="height:650px;">
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Opiniator</h3>
                    <span>Do 10 comments</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Citizen</h3>
                    <span>Do 10 votes</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Navigator</h3>
                    <span>Read 5 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Cultured</h3>
                    <span>Read 25 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Readaholic</h3>
                    <span>Read 100 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Writer</h3>
                    <span>Publish a news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Senior Writer</h3>
                    <span>Publish 20 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Scribophile</h3>
                    <span>Publish 100 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Scribophile</h3>
                    <span>Publish 100 news</span>

                  </div>
                  <div class="badge d-flex flex-column flex-wrap align-items-center">

                    <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
                    <h3>Scribophile</h3>
                    <span>Publish 100 news</span>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-wrap flex-row mx-auto mt-3" data-toggle="modal" data-target="#badgesModal" style="cursor:pointer">

            @if ($achieved_badges != null)
                @include('partials.badge_list',$achieved_badges)
            @endif
          </div>

        </div>

      </div>

      <div class="col-lg-8 col-12 mt-3 mx-2">
        <div class="row p-2">
          <h2>Articles</h2>
        </div>
        <div class="row p-2">
          <div class="col">
            <div class="d-flex flex-column mx-auto">

              <!-- 1st News Item -->
              <div style="display: block;" class="news_box news_item border container my-2">
                <div class="row" style="position:relative;">
                  <div class="col col-sm-auto my-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Jared_Kushner_Cropped.jpg/378px-Jared_Kushner_Cropped.jpg"
                      width="100px" height="100px" alt="Icon">
                  </div>
                  <div class="col">
                    <div class="row">
                      <h3 class="font-weight-normal">Kushner, Russia bombshells rock the White House</h3>
                    </div>
                    <div class="row">
                      <p><span class="font-weight-bold">101 points</span> &middot; JoanaMoreira &middot; 12:25 23/02/2018</p>
                    </div>
                    <div class="row">
                      <p>A volley of stunning revelations over Jared Kushner and the Russia probe are rocking Donald Trump's
                        inner circle and suggest a pivotal moment is at hand in the West Wing personnel wars that have raged
                        throughout his presidency. First...</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 2nd News Item -->
              <div style="display: block;" class="news_box news_item border container my-2">
                <div class="row" style="position:relative;">
                  <div class="col col-sm-auto my-2">
                    <img src="https://ichef-1.bbci.co.uk/news/660/cpsprodpb/1327D/production/_100216487_hi045211153-2.jpg" width="100px" height="100px"
                      alt="Icon">
                  </div>
                  <div class="col">
                    <div class="row">
                      <h3 class="font-weight-normal">Reality Check: What does the EU Brexit draft reveal?</h3>
                    </div>
                    <div class="row">
                      <p><span class="font-weight-bold">101 points</span> &middot; JoanaMoreira &middot; 12:25 23/02/2018</p>
                    </div>
                    <div class="row">
                      <p>After months of talking we've finally got our first look at a draft of the agreement which is designed
                        to take the UK out of the European Union. This is a long and complex legal document. It is the European
                        Commission's draft of a withdrawal agreement, which...</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 3rd News Item -->
              <div style="display: block;" class="news_box news_item border container my-2">
                <div class="row" style="position:relative;">
                  <div class="col col-sm-auto my-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/71/Meghan_Markle_in_January_2013.jpg" width="100px" height="100px"
                      alt="Icon">
                    <!-- By Genevieve (DSC_3228) [CC BY 2.0 (http://creativecommons.org/licenses/by/2.0)], via Wikimedia Commons -->
                  </div>
                  <div class="col">
                    <div class="row">
                      <h3 class="font-weight-normal">Meghan Markle wants to 'hit ground running' with royal charity work</h3>
                    </div>
                    <div class="row">
                      <p><span class="font-weight-bold">101 points</span> &middot; JoanaMoreira &middot; 12:25 23/02/2018</p>
                    </div>
                    <div class="row">
                      <p>Meghan Markle wants to "shine a light on women feeling empowered" as she begins to work with royal
                        charities. She said she hoped to "hit the ground running" as she joined Prince Harry and the Duke
                        and Duchess of Cambridge to discuss their foundation. Her fiance...</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 4th News Item -->
              <div style="display: block;" class="news_box news_item border container my-2">
                <div class="row" style="position:relative;">
                  <div class="col col-sm-auto my-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Amazon_logo_plain.svg/2000px-Amazon_logo_plain.svg.png"
                      width="100px" height="100px" alt="Icon">
                  </div>
                  <div class="col">
                    <div class="row">
                      <h3 class="font-weight-normal">Amazon is buying Ring, a business that was once rejected on 'Shark Tank'</h3>
                    </div>
                    <div class="row">
                      <p><span class="font-weight-bold">101 points</span> &middot; JoanaMoreira &middot; 12:25 23/02/2018</p>
                    </div>
                    <div class="row">
                      <p>Tuesday, Amazon agreed to buy Ring, a company that makes smart doorbells, according to representatives
                        of both companies. "Ring's home security products and services have delighted customers since day
                        one. We're excited to work with this talented team,"...</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <a href="#" class="loadMore" style="text-decoration: none; display: none;">Show More</a>
                </div>
                <div class="col text-right">
                  <p class="totop">
                    <a style="text-decoration: none; display: none;" href="#top">Back to top</a>
                  </p>
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>

    </div>
  </div>

