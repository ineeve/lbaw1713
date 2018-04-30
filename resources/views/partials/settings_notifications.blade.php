<div class="tab-pane fade" id="notifications">
  <h3>Manage Notifications</h3>
  <fieldset class="pt-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="CommentMyPost" <?php if($userNotifs->contains('CommentMyPost')) echo "checked"; ?>>
        <label class="custom-control-label" for="CommentMyPost">
          Comments to my articles
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="VoteMyPost" <?php if($userNotifs->contains('VoteMyPost')) echo "checked"; ?>>
        <label class="custom-control-label" for="VoteMyPost">
          Votes in my articles
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="FollowedPublish" <?php if($userNotifs->contains('FollowedPublish')) echo "checked"; ?>>
        <label class="custom-control-label" for="FollowedPublish">
          Articles from people I follow
        </label>
      </div>
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" value="" id="FollowMe" <?php if($userNotifs->contains('FollowMe')) echo "checked"; ?>>
        <label class="custom-control-label" for="FollowMe">
          New articles of my interest
        </label>
      </div>
    </div>
  </fieldset>
</div>