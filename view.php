<?php
include('connect.php');

$islandID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($islandID > 0) {
    $stmt = $conn->prepare("
        SELECT c.islandContentID, c.image, c.content, c.color AS contentColor
        FROM islandcontents c
        WHERE c.islandOfPersonalityID = ?
    ");
    $stmt->bind_param('i', $islandID);
    $stmt->execute();
    $result = $stmt->get_result();

    $islandContents = [];
    while ($row = $result->fetch_assoc()) {
        $islandContents[] = [
            'islandContentID' => $row['islandContentID'],
            'image' => $row['image'], 
            'content' => $row['content'],
            'color' => $row['contentColor']
        ];
    }

    if (empty($islandContents)) {
        echo '<p>No content found for this island.</p>';
        exit;
    }
} else {
    echo '<p>Island ID is missing or invalid.</p>';
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Island Content - Johann's Brain</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <?php if (!empty($islandContents)): ?>
    <header class="bgimg w3-display-container" id="home">
        <img src="images/<?php echo htmlspecialchars($islandContents[0]['image']); ?>" 
             alt="<?php echo htmlspecialchars($islandContents[0]['content']); ?>" 
             class="img-fluid" 
             style="border-radius: 8px; width: 100%; height: auto; object-fit: contain;">
    </header>
  <?php endif; ?>

  <div class="container py-5">
    <h1 class="text-center mb-5">Island Content</h1>

    <div class="row justify-content-center">
      <?php foreach ($islandContents as $content): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card text-center" style="color: <?php echo htmlspecialchars($content['color']); ?>; border: 1px solid #ddd;">
            <div class="card-body">
              <p style="font-size: 16px;"><?php echo htmlspecialchars($content['content']); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <a href="index.php" class="btn btn-success btn-lg d-block mx-auto mt-4">
      Back to Islands
    </a>
  </div>

  <footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
    <p>@Whohann</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
