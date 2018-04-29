<div class="tab-pane fade" id="notifications">
  <h3>Manage Notifications</h3>
  <fieldset class="pt-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="article-comments" <?php if($userNotifs->contains('CommentMyPost')) echo "checked"; ?>>
        <label class="custom-control-label" for="article-comments">
          Comments to my articles
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="article-votes" <?php if($userNotifs->contains('VoteMyPost')) echo "checked"; ?>>
        <label class="custom-control-label" for="article-votes">
          Votes in my articles
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="follow-articles" <?php if($userNotifs->contains('FollowedPublish')) echo "checked"; ?>>
        <label class="custom-control-label" for="follow-articles">
          Articles from people I follow
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="article-interest" <?php if($userNotifs->contains('FollowMe')) echo "checked"; ?>>
        <label class="custom-control-label" for="article-interest">
          New articles of my interest
        </label>
      </div>
    </div>
  </fieldset>
</div>