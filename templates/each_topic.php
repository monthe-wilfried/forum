<?php include('includes/header.php');  ?>
<ul id="topics">
          <li id="main-topic" class="topic topic">
            <div class="row">
              <?php if($replies) : ?>
                      <?php foreach($replies as $reply) : ?>
              <div class="col-md-2">
                <div class="user-info">
                  <img class="avatar img-thumbnail pull-left" src="img/avatars/<?php echo $reply['avatar']; ?>" />
                  <ul>
                    <li><strong><?php echo $reply['username']; ?></strong></li>
                    <li><?php echo postCount($reply['user_id'])." Posts"; ?></li>
                    <li><a href="profile.php">Profile</a>
                  </ul>
                </div>
              </div>
              <div class="col-md-10">
                <div class="topic-content pull-right">
                  <p><?php echo $reply['body']; ?></p>
                </div>
              </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="well"><p>There are no replies</p></div>
            <?php endif; ?>
            </div>
          </li>
        </ul>
        <h3>Reply To Topic</h3>
        <form role="form">        
            <div class="form-group">
            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
            <script>
              CKEDITOR.replace( 'reply' );
                  </script>
            </div>
           <button type="submit" class="btn btn-default">Submit</button>
        </form>

<?php include('includes/footer.php');  ?>        