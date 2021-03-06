<?php 
  include_once(__DIR__."/classes/Message.php");
  $activePage = basename($_SERVER['PHP_SELF'],'.php');
  $user = User::getCurrentUser($_SESSION['user']);
  //Select unreadNotifications
  $notifsBySender = Message::getUnreadNotifBySender($user['id']);

  $ammountNotif = count($notifsBySender);

  //SEARCH BRYAN
  include_once(__DIR__ . "/classes/Search.php");

  $searchReturned = null;

  if(!empty($_POST['name']) || !empty($_POST['preferences']) || !empty($_POST['genres'])){
      try {
          //code...
          $search = new Search();
          $search->setName($_POST['name']);
          $search->setPreference($_POST['preferences']);
          $search->setGenre($_POST['genres']);
          $searchReturned = $search->getData();
      } catch (\Throwable $th) {
          //throw $th;
          $error = $th->getMessage();
      }
  }

  //END SEARCH
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="img/Untitled-1.png" width="100" height="auto" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- SEARCH BRYAN -->
    <div class="search-container">
        <form action="index.php" method="POST" id="searchform">
          <div class="d-flex flex-row">
            <label for="preferences" id="prefLabel">Preference</label>
            <select name="preferences" id="preferences" form="searchform">
              <option value=""></option>
              <option value="design">Design</option>
              <option value="development">Development</option>
            </select>
          </div>

          <div class="d-flex flex-row"> 
            <label for="genres" id="genresLabel">Genre</label>
            <select name="genres" id="genres" form="searchform">
              <option value=""></option>
              <option value="Pop">Pop</option>
              <option value="Rock">Rock</option>
              <option value="R&B">R&B</option>
              <option value="Latin">Latin</option>
              <option value="Drum-'n-bass">Drum-'n-bass</option>
              <option value="classic">Classic</option>
            </select>
          </div>
          <div class="d-flex flex-row"> 
            <label for="name" id="nameLabel">Name</label>
            <input type="text" name="name" placeholder="name" id="name">
          </div>
          <input type="submit" name="search-action" value="Search" id="searchBtn"></input>

        </form>
    </div>
    <!-- END SEARCH BRYAN -->
    <ul class="navbar-nav">
      <li class="nav-item <?php echo ($activePage == "index")? "active":""; ?>">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo ($activePage == "profilePage")? "active":""; ?>">
        <a class="nav-link" href="profilePage.php">My Profile</a>
      </li>
      <li class="nav-item  <?php echo ($activePage == "FAQ")? "active":""; ?>">
        <a class="nav-link" href="FAQ.php">FAQ</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link <?php echo ($ammountNotif > 0)? "dropdown-toggle": "disabled"; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notification<?php echo ($ammountNotif > 0)? ": ".$ammountNotif: ""; ?>
        </a>
        <?php if($ammountNotif > 0): ?>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
            foreach($notifsBySender as $notif): 
              $senderInfo = User::getUserInfo($notif['senderId']);
          ?>
            <a class="dropdown-item" href="chat.php?buddyId=<?php echo htmlspecialchars($senderInfo->userId); ?>">
              <?php echo htmlspecialchars($senderInfo->firstname)." ".htmlspecialchars($senderInfo->lastname)." has sent you a message";?>
            </a>
          <?php endforeach; ?>
        </div>
            <?php endif; ?>
      </li>
      <li class="nav-item logout">
        <a class="nav-link" href="logout.php" id="white">Logout</a>
      </li>
    </ul>
  </div>
</nav>