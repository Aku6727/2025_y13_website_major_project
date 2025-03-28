<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
  <body class = "bg-dark">
    <!-- Include the navbar -->
    <?php
      include("navbar.php")
    ?>
    <!-- Add the main image with slogan -->
    <div? class = "hero_index">
      <!-- hero image -->
      <img src="images/gaming_mouse.jpg" alt="Mouse" class="background_index_image">
      <!-- Slogan -->
      <h1 class = "hero_text">Innovation elevated</h1>
    </div>
    <!-- The main section taling about the company's policys -->
    <div class="container bg-dark">
      <div class="row align-items-center">
        <div class="col-md-6 text-center">
          <img src="images/ultra_lightweight_gaming_mouse.jpg" alt="Gaming Mouse" class="product-image">
        </div>
        <div class="col-md-6 text-column">
          <h2 class="mb-4 text-light fst-italic index_custom ">Precision in Your Palm</h2>
          <p class = "text-light index_custom">
          At Voidtech, we believe that performance isn't optional — it's expected. Every product we craft undergoes rigorous testing, relentless iteration, and unmatched attention to detail. From concept to creation, we push boundaries so you can break them.
          Design That Performs
          Our philosophy is simple: form follows function. But at Voidtech, we don't settle for one or the other — we deliver both. Sleek, futuristic design paired with lightning-fast performance means you're not just using technology. You're wielding it.
          Uncompromising Innovation
          We don't wait for the future to arrive — we build it. With a dedicated R&D division and global partnerships, Voidtech stays ahead of the curve, harnessing AI, machine learning, and next-gen engineering to power the tools of tomorrow.
          Trusted by the Best
          From elite gamers to global enterprises, Voidtech is the backbone of those who demand excellence. When downtime isn't an option and every millisecond matters, there's only one name you can trust.
          Voidtech. No Limits. No Compromise. Just Power.
          </p>
        </div>
      </div>
    </div>
    
  </body>
</html>