<?php
include('connect.php');

$query = "SELECT * FROM islandsofpersonality";

$result = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Johann's Brain</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/memoryIcon.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <div class="w3-top w3-hide-small">
    <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
      <h3>
        <a href="#" class="w3-bar-item w3-button">HOME</a>
        <a href="#islands" class="w3-bar-item w3-button">PERSONAL ISLANDS</a>
        <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
      </h3>
    </div>
  </div>

  <header class="bgimg w3-display-container" id="home">
    <div class="w3-display-middle w3-center">
      <h1 class="w3-text-white w3-hide-small" style="font-size:150px">
        <span class="letter" style="color: #ffdc17;">C</span>
        <span class="letter" style="color: #45fd67;">O</span>
        <span class="letter" style="color: #0057bb;">R</span>
        <span class="letter" style="color: #ff73e8;">E</span>
        <span class="letter" style="color: #ff4b4b;">M</span>
        <span class="letter" style="color: #61ffdd;">O</span>
        <span class="letter" style="color: #6e55ff;">R</span>
        <span class="letter" style="color: #bf88ff;">I</span>
        <span class="letter" style="color: #ffb070;">E</span>
        <span class="letter" style="color: #944700;">S</span>
      </h1>
      <h1 class="w3-text-white w3-hide-small" style="font-size:100px">Johann's Islands</h1>
      <h2 class="w3-text-white w3-hide-large w3-hide-medium" style="font-size:60px"><b>COREMORIES</b></h2>
      <h2>
        <a href="#islands" class="w3-button w3-xxlarge w3-black"
          style="border-radius: 50px; padding: 10px 20px; transition: all 0.3s ease;">
          G O
        </a>
      </h2>
    </div>
    <video autoplay muted loop class="w3-display-container bg-video">
      <source src="images/memoriesbg.mp4" type="video/mp4">
    </video>
  </header>

  <div class="w3-container w3-black w3-padding-64 w3-xxlarge" id="islands">
  <div class="container">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px; font-family: 'Amatic SC', sans-serif;">PERSONAL ISLANDS</h1>
    <div class="row">
      <?php
      while ($row = $result->fetch_assoc()) {

        $hoverClass = '';

        switch ($row["name"]) {
          case 'Island of Art':
            $hoverClass = 'w3-hover-pale-yellow';
            break;
          case 'Island of Marvel':
            $hoverClass = 'w3-hover-pale-red';
            break;
          case 'Island of Nature':
            $hoverClass = 'w3-hover-pale-green';
            break;
          case 'Island of Horror':
            $hoverClass = 'w3-hover-white';
            break;
          case 'Island of Cats':
            $hoverClass = 'w3-hover-pale-blue';
            break;
          default:
            $hoverClass = 'w3-hover-pale-yellow';
        }

        echo '<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
        <a href="javascript:void(0)" onclick="openIsland(event, \'Island' . $row["islandOfPersonalityID"] . '\');">
          <div class="tablink w3-padding-large ' . $hoverClass . '" style="width: 300px; height: 300px; margin: 0 auto; overflow: hidden;">
            <img src="images/' . $row["islandOfPersonalityID"] . '.svg" alt="' . $row["name"] . '" class="w3-image img-fluid" style=" width: 100%; height: 100%; object-fit: cover;">
            <p class="text-center" style="position: absolute; bottom: 10px; left: 0; right: 0; color: white; font-family: \'Amatic SC\', sans-serif; text-align: center; margin: 0;">' . $row["name"] . '</p>
          </div>
        </a>
      </div>';


      }
      ?>
    </div>
  </div>
</div>


  <?php

  $result->data_seek(0);

  while ($row = $result->fetch_assoc()) {
    echo '
    <div id="Island' . $row["islandOfPersonalityID"] . '" class="w3-container islands w3-padding-64 w3-center" 
        style="margin: 0 auto; max-width: 800px; border-radius: 8px; margin-top: 30px; background-color: #f9f9f9; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
      <h1 style="color: ' . $row["color"] . '; font-size: 48px; margin-bottom: 20px;">
        <b>' . $row["name"] . '</b>
      </h1>
      
      <p class="w3-text-grey w3-large w3-margin-top" style="margin-top: 30px; line-height: 1.6;">' . $row["shortDescription"] . '</p>
      <hr style="margin: 40px 0; border-top: 1px solid #ddd;">
      <p class="w3-text-black w3-large" style="line-height: 1.8;">' . $row["longDescription"] . '</p>
    <a href="view.php?id=' . $row["islandOfPersonalityID"] . '" class="w3-button w3-round w3-hover-opacity" 
   style="background-color: ' . $row["color"] . '; color: white; font-size: 18px; padding: 12px 24px; text-decoration: none;">
    GO
</a>
    </div>';
  }

  $conn->close();
  ?>

  <div class="w3-container w3-padding-64 w3-light-blue w3-xlarge" id="about">
    <div class="container">
      <h1 class="w3-center w3-jumbo w3-text-black" style="margin-bottom:64px">About</h1>
      <p class="w3-text-black justified-text">
        Coremories is a journey into the depths of your heart and mind, where every memory is an
        island of its own. It's a place where time stands still, emotions run deep, and the past comes alive.
      </p>
   
    </div>
  </div>

  <footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
    <p>@Whohann</p>
  </footer>

  <script>
    function openIsland(evt, islandName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("islands");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-black", "");
      }
      document.getElementById(islandName).style.display = "block";
      evt.currentTarget.firstElementChild.className += " w3-black";
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>