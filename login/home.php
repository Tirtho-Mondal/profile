<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
      header("Location: index.php");
      exit(); // Added exit to stop further execution
   }

   // Moved inside session check
   $id = $_SESSION['id'];
   $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
   if (!$query) {
      die("Database query failed."); // Added error handling
   }

   // Fetch user data
   if ($result = mysqli_fetch_assoc($query)) {
      $res_Uname = $result['Username'];
      $res_Email = $result['Email'];
      $res_Age = $result['Age'];
      $res_id = $result['id'];
   } else {
      // Handle if user data is not found
      die("User data not found.");
   }
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
    <style>
         .section {
            text-align: center;
            margin-top: 30px;
        }
        .section .box {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            animation: fadeInUp 1s ease forwards; /* Add animation */
            opacity: 0; /* Start with opacity 0 */
        }
        .section .box p {
            margin: 0;
        }
        .section .box p b {
            font-weight: bold;
        }
        .section .bottom .box {
            background-color: #e0e0e0;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        
        /* Define the animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="logo">
        <a href="php/logout.php"><button class="btn">Log Out</button></a>
            <a href="home.php"><img src="../img/logo" alt=""></a>
        </div>
        <nav class="right-links">
            <a href='edit.php?Id=<?php echo $res_id ?>' align="right">Change Profile</a> <!-- Corrected alignment -->
        </nav>
    </header>

    <main>
        <section class="section">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b><?php echo $res_Age ?> years old</b>.</p> 
                </div>
            </div>
        </section>
        
        <div class="section"
        style="display: flex;
            flex-direction: column;
            width: 200px;
            ">
            <a href="../About/about.php" class="button">Profile</a>
            
            <a href="../About/about_me.php" class="button">About Me</a>
            
            <a href="../About/project.php" class="button">Project</a>
            <a href="../About/skill.php" class="button">Skill</a>
            <a href="../About/time_edu.php" class="button">Education</a>
            <a href="../About/time_exap.php" class="button">Experience</a>
            <a href="../About/social.php" class="button">Social Media</a>
            <a href="../About/message.php" class="button">Messages</a>
            
            <a href="../About/get_in_touch.php" class="button">Get In Touch</a>
            <!-- <a href="../About/port.php" class="button">Port</a> -->
            
        </div>
    </main>
</body>
</html>