<?php
include 'connection.php';
if(!(isset($_SESSION['login']))){
      header("Location:login.php");
   }
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="style.css">
   <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
   <title></title>
</head>
<body>
  <div class="container">
<header>
      <button class="button login" id="logout"><a href="logout.php">Logout</a></button>
   
</header>

<div id="avatars">
  <h1>Select Avatar</h1>
  <h2>This game is for children aged between six and ten</h2>
  <label class="avatars">
    <input type="radio" value="fox avatar.png" name="avatar"/>
    <img src="avatar/fox avatar.png" alt=""/>
  </label>
  
  <label class="avatars">
    <input type="radio" value="monster avatar.png" name="avatar"/>
    <img src="avatar/monster avatar.png" alt=""/>
  </label>
  
  <label class="avatars">
    <input type="radio" value="superhero avatar.png" name="avatar"/>
    <img src="avatar/superhero avatar.png" alt=""/>
  </label>
    <label class="avatars">
    <input type="radio" value="ninja avatar.png" name="avatar"/>
    <img src="avatar/ninja avatar.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="math orange avatar.png" name="avatar"/>
    <img src="avatar/math orange avatar.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="helmet avatar.png" name="avatar"/>
    <img src="avatar/helmet avatar.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="Deus_mathematics.png" name="avatar"/>
    <img src="avatar/Deus_mathematics.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="cute_avatar.png" name="avatar"/>
    <img src="avatar/cute_avatar.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="girl_avatar.png" name="avatar"/>
    <img src="avatar/girl_avatar.png" alt=""/>
  </label>
  <label class="avatars">
    <input type="radio" value="boy_avatar-removebg-preview.png" name="avatar"/>
    <img src="avatar/boy_avatar-removebg-preview.png" alt=""/>
  </label>
<input type="hidden" id="u_id" value="<?php echo $_SESSION['id'];?>" name="">
  
</div>
<div id="leves">
    <h1>Select your Level</h1>
    <button data-time = "5:00">Easy</button>
    <button data-time="0:30">Hard</button>
  </div>
<div id="netbt"><button>Next</button></div>
  <div class="time" style="display: none;">Time left = <span id="timer"></span></div>

    <div class="game" style="display:none"></div>

    <div class="container">
  <table id="scoreboard" style="display:none;" class="table striped">
  <thead>
    <tr class="header">
      <th>User</th>
      <th>Avatar</th>
      <th>Score</th>
    </tr>
  </thead>
  <tbody id="table_data">
  </tbody>
</table>
</div>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script src="app.js"></script>


 

</div>
</body>
</html>

