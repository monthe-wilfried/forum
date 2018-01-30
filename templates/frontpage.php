<?php include('includes/header.php');  ?>

              <ul id="topics">
                <?php if($topics) : ?>
                  <?php foreach($topics as $topic) : ?>
                <li class="topic">
                  <div class="row">
                    <div class="col-md-2">
                      <img class="avatar img-thumbnail pull-left" src="img/avatars/<?php echo $topic['avatar']; ?>" />
                    </div>
                    <div class="col-md-10">
                      <div class="topic-content pull-right">
                        <h3><a href="topic.php?id=<?php echo urlFormat($topic['id']); ?>?user=<?php echo urlFormat($topic['user_id']); ?>"><?php echo $topic['title']; ?></a></h3>
                        <div class="topic-info">
                          <a href="topics.php?category=<?php echo urlFormat($topic['category_id']);  ?>"><?php echo $topic['name']; ?></a> >> <a href="topics.php?user=<?php echo urlFormat($topic['user_id']);  ?>"><?php echo $topic['username']; ?></a> >> Posted on: <?php echo dateFormat($topic['create_date']); ?> 
                          <span class="badge pull-right"><?php echo replyTopicCount($topic['id']);  ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
              </ul>
              <?php else : ?>
                <div class="well"><p>There are no topics.</p></div>
              <?php endif; ?>
              <h3>Forum Statistics</h3>
                <ul>
                  <li>Total Number of Users: <strong><?php echo $totalUsers; ?></strong></li>
                  <li>Total Number of Topics: <strong><?php echo $totalTopics; ?></strong></li>
                  <li>Total Number of Categories: <strong><?php echo $totalCategories; ?></strong></li>
                </ul>

<?php include('includes/footer.php');  ?>        