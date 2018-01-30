</div><!-- /.block -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="sidebar">
            <div class="block">
              <h3>Login Form</h3>
              <?php if(isLoggedIn()) : ?>
                <div class="userdata">Welcome, <?php echo getUser()['username']; ?></div>
                <br>
                <form role="form" method="post" action="logout.php">
                  <input type="submit" name="do_logout" value="Logout" class="btn btn-primary">
                </form>
              <?php else : ?>
              <form role="form" method="post" action="login.php">
                <div class="form-group">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Enter Password">
                </div>      
                <button name="do_login" type="submit" class="btn btn-primary">Login</button> <a  class="btn btn-default" href="register.php"> Create Account</a>
              </form>
            <?php endif; ?>
            </div>
          
            <div class="block">
              <h3>Categories</h3>
              <div class="list-group">
                <a href="topics.php" class="list-group-item active">All Topics<span class="badge pull-right"><?php echo $totalTopics; ?></span></a> 
                <?php if($categories) : ?>
                    <?php foreach($categories as $category) : ?>
                        <a href="topics.php?category=<?php echo urlFormat($category['id']); ?>" class="list-group-item"><?php echo $category['name']; ?><span class="badge pull-right"><?php echo topicCount($category['id']); ?></span></a>
                    <?php endforeach; ?>
                <?php else: ?>
                  <div class="well"><p>There are no categoeries.</p></div>
                <?php endif; ?>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo BASE_URL; ?>templates/js/bootstrap.js"></script>
  </body>
</html>
