<?php
//ini_set('display_errors', '0');
//ini_set('log_errors', 1);
error_reporting(^E_ERROR | ^E_WARNING | ^E_PARSE);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>OnTrack - Homepage</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="homepage.css">
  </head>

  <body>
    <header>
      <p id="logo">OnTrack</p>
      <nav>
        <ul class="nav_links">
          <li><a href="#about">About</a></li>
          <li><a href="#whytrack">Why track</a></li>
          <li><a href="#tips">Tips</a></li>
        </ul>
      </nav>
      <a href="login.php"><button id="login_btn">Log in</button></a>
    </header>

    <section class="frontpage">
      <div class="center">
        <h1>OnTrack</h1>
        <p class="subtitle">Track to stay on track</p>
      </div>
      <div class="center">
        <a href="signup.php"><button id="signup_btn">sign up</button></a>
      </div>
      <div class="center">
        <a href="#about"><p class="subtitle" id="learnmore">learn more</p></a>
      </div>
    </section>

    <section class="about" id="about">
      <div>
        <h1 style="font-family:font1">YOUtrition</h1>
        <p>It's a simple fact: tasty food makes life enjoyable. However, many of us don't eat well - we may be too busy to bother, or too stressed out about over-indulging, or simply aren't sure what nutrients we need. We designed OnTrack for you. Eat comfortably as OnTrack does the tracking for you. We'll help you discover your eating habits, make smarter decisions, and connect you with professionals.</p>
        <br>
        <p>OnTrack is nutrition made easy and personal. Nutrition for YOU.</p>
      </div>
    </section>

    <section class="whytrack" id="whytrack">
      <div>
        <h1 style="font-family:font1">Diet Tracking</h1>
        <p>Forgetting your meals and eating for lack of anything else to do creates bad habits and/or relationships with food. When it comes to your well-being, you shouldn’t be stumbling in the dark. Tracking shows the path to better eating because it…</p>
        <br>
        <ul class="regularlist">
          <li>Makes you aware of what you’re eating and why</li>
          <li>Allows you to adjust your schedule by showing your eating habits</li>
          <li>Gives you the opportunity to create better eating habits</li>
          <li>Helps you set measurable goals by giving you a reference point</li>
          <li>Detects allergies, intolerances, and deficiencies</li>
        </ul>
      </div>
    </section>

    <section class="tips" id="tips">
      <div>
        <h1 style="font-family:font1">Tips</h1>
        <p>To get the most out of OnTrack, consider setting <b>SMART goals</b> and thinking about <b>why</b> you’re eating to promote mindfulness–for example, are you eating because you’re hungry? Additionally,  <b>check in occasionally with your dietician</b>–in OnTrack, you can connect your dietician to allow them to contact you easily and leave comments on your diet tracker</p>
        <br>
        <p>Try to write your logs <b>immediately after you eat</b>, rather than leaving it all for the end of the day. Keeping your logs brief will help you save time and maintain concise and clean records. Don’t forget to include details like how you’re feeling, who you’re eating with, and how your meal was prepared (ie. fried, boiled, etc).</p>
        <br>
        <p>Lastly, remember that starting a new habit is hard!  <b>So be kind to yourself</b>!</p>
      </div>
    </section>

  </body>

</html>