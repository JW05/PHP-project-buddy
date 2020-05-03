<?php 
  include_once(__DIR__."/classes/Message.php");
  $activePage = basename($_SERVER['PHP_SELF'],'.php');
  $user = User::getCurrentUser($_SESSION['user']);
  //Select unreadNotifications
  $notifsBySender = Message::getUnreadNotifBySender($user['id']);

  $ammountNotif = count($notifsBySender);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="img/Untitled-1.png" width="100" height="auto" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($activePage == "index")? "active":""; ?>">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo ($activePage == "profilePage")? "active":""; ?>">
        <a class="nav-link" href="profilePage.php">My Profile</a>
      </li>
      <li class="nav-item  <?php echo ($activePage == "profileSetting")? "active":""; ?>">
        <a class="nav-link" href="profileSetting.php">My Account</a>
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
    </ul>
    <ul class="navbar-nav float-right">
      <li class="nav-item logout">
        <a class="nav-link" href="logout.php" id="white">Logout</a>
      </li>
    </ul>
  </div>
</nav>