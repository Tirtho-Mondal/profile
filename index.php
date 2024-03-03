
<?php 
   include("About/config.php");
   $res=mysqli_query($db,'select* from about where id=1');
   $row=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirtho Mondal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <span><a href="#home"><img src="img/img/logo.png" height="80" width="80" alt=""></a></span>
        </div>
        <ul class=" navlist">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#timeline">Timeline</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login/index.php">Login</a></li>





        </ul>
        <div id="menu-icon" ><img src="img/menu.png" alt="" height="50" weight="50"></div>

        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            


            <div class="menu-links">
                <li><a href="#home" onclick="toggleMenu()">Home</a></li>
                <li><a href="#about" onclick="toggleMenu()">About</a></li>
                <li><a href="#timeline" onclick="toggleMenu()">Timeline</a></li>
                <li><a href="#projects" onclick="toggleMenu()">Projects</a></li>
                <li><a href="#skills" onclick="toggleMenu()">Skills</a></li>
                <li><a href="#contact" onclick="toggleMenu()">Contact</a></li>
            </div>
        </div>
        <div>
            <img src="img/moon.png" id ="icon">
        </div>

    </header>


    <!-- home section    -->
<?php
    $email = "tirthomondal.2001@gmail.com";
?>

<section id="home" class="home">
    <div class="home-content">
        <h1>
            Hi! I'm <?php echo $row['name']; ?>
        </h1>
        <div class="change-text">
            <h3>And I'm</h3>
            <h3>
                <span class="word">Student</span>
                <span class="word">Youtuber</span>
                <span class="word">Photographer</span>
            </h3>
        </div>

        <p>
            <?php echo $row['description']; ?>
        </p>

        <div class="info-box">
            <div class="mailto">
                <a href="mailto:<?php echo $email; ?>">Send Email</a>
            </div>
        </div>

        <div class="center-container">
            <div class="btn__container">
                <button class="btn btn-color-2" onclick="window.open('<?php echo $row['link'];?>')">Download CV</button>
                <button class="btn btn-color-1" onclick="location.href='./#contact'">Contact Info</button>
            </div>
        </div>

        <div id="socials-container">

        <?php

$social = "SELECT * FROM social_media_profiles";
$res = mysqli_query($db, $social);

// Check if there are any rows in the result
if (mysqli_num_rows($res) > 0) {

    echo "<table>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<th>";
        
        echo "<td><img src='About/" . $row['img'] . "' alt='" . $row['alt'] . "' class='icon' onclick=\"window.open('" . $row['link'] . "')\" /></td>";
        echo "</th>";
    }

    echo "</table>";
} 
?>

         



        </div>
    </div>

    <div class="home-image">
        <div class="img-box">
        <?php
   $res=mysqli_query($db,'select* from about where id=1');
   $row=mysqli_fetch_array($res);?>
            <img src="<?php echo 'About/'.$row['image']; ?>" width="445" height="561" alt="">
        </div>
    </div>
</section>


<?php
    // Fetching data from the database
    $query = "SELECT * FROM about_me_content";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image_path'];
        $about_content = $row['about_content'];
    } else {
        $image_path = "default.jpg"; 
        $about_content = "No content available.";
    }
?>
<section id="about" class="about">
    <div class="img-about">
        <img src="<?php echo'About/uploads/'. $image_path; ?>" alt="">
    </div>
    <div class="about-content">
        <h2 align="center" style="color: blue;">About Me</h2>
        <p><?php echo $about_content; ?></p>
    </div>
</section>


<?php


// Fetch education data from the database
$eduQuery = mysqli_query($db, "SELECT * FROM education");
$education = mysqli_fetch_all($eduQuery, MYSQLI_ASSOC);

// Fetch experience data from the database
$expQuery = mysqli_query($db, "SELECT * FROM experience");
$experience = mysqli_fetch_all($expQuery, MYSQLI_ASSOC);
?>

<section id="timeline" class="timeline">
    <div class="my-timeline">
        <p><h1 align="center">Explore me</h1></p>
    </div>
    <div class="container">
        <main class="row">
            <!-- Education Section Starts -->
            <section class="col">
                <header class="title">
                    <h2>EDUCATION</h2>
                </header>
                <div class="contents">
                    <?php foreach ($education as $edu): ?>
                    <div class="box">
                        <h4><?php echo $edu['date_range']; ?></h4>
                        <h3><?php echo $edu['degree']; ?></h3>
                        <h3><?php echo $edu['institution']; ?></h3>
                        <p><?php echo $edu['details']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <!-- Education Section Ends -->
            <!-- Experience Section Starts -->
            <section class="col">
                <header class="title">
                    <h2>EXPERIENCE</h2>
                </header>
                <div class="contents">
                    <?php foreach ($experience as $exp): ?>
                    <div class="box">
                        <h4><?php echo $exp['date_range']; ?></h4>
                        <h3><?php echo $exp['position']; ?></h3>
                        <p><?php echo $exp['description']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <!-- Experience Section Ends -->
        </main>
    </div>
</section>






















<!-- project section -->


<?php



// Fetch projects from the database
$proj = "SELECT * FROM projects";
$result = mysqli_query($db, $proj);

// Initialize HTML output variable
$html_output = '';

// Check if there are any projects
if ($result) {
    // Check if there are any projects returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each project and generate HTML markup
        while ($row = mysqli_fetch_assoc($result)) {
            $html_output .= '
            <div class="item">
                <div class="left">
                    <div class="img">
                        <img src="About/' . $row["img_src"] . '" width="500" height="500" alt="project image">
                    </div>
                </div>
                <div class="right">
                    <h2 class="project-title">' . $row["title"] . '</h2>
                    <h3 class="project-sub-title">' . $row["sub_title"] . '</h3>
                    <p class="project-desc">' . $row["desc"] . '</p>
                    <div class="btn-container-load">
                        <div class="tablecontainer">
                            <table>
                                <tr>
                                    <td class="button-cell">
                                        <button class="charming-btn" onclick="window.open(\'' . $row["github_link"] . '\')">Know More</button>
                                    </td>
                                    <td class="preview-cell">
                                        <a href="#" class="primary-btn outline external-link">
                                            <span>Preview</span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        // No projects found
        $html_output = "No projects found.";
    }
} else {
    // Error in query execution
    $html_output = "Error fetching projects: " . mysqli_error($db);
}



// Combine all HTML
echo '
<section id="projects" class ="projects">
    <div class="projectcontainer">
        <div class="containerprojecthead">
            <h2 class="project-heding">
                <span>P</span>
                <span>r</span>
                <span>o</span>
                <span>j</span>
                <span>e</span>
                <span>c</span>
                <span>t</span>
                <span>s</span>
                <span> </span>
                <span>A</span>
                <span>r</span>
                <span>e</span>
            </h2>
        </div>
        <div class="all-items">
            ' . $html_output . '
        </div>
    </div>
</section>';
?>
















<!-- skill section -->
<section id="skills" class="skills">
    <div class="containerSkillhead">
        <h2 class="colorful-heading">My Skills</h2>
    </div>

    
    <?php
// Assuming you have already connected to your database using mysqli

// Fetch skills from the database
$query = "SELECT * FROM skills";
$result = mysqli_query($db, $query);

// Initialize counter variable
$count = 1;

// Check if there are any skills
if(mysqli_num_rows($result) > 0) {
    ?>
    <div class="myskill">
        <?php
        // Loop through each skill and generate HTML markup
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="containerskill <?php echo $count % 2 == 0 ? 'left-container' : 'right-container'; ?>">
                <img src="<?php echo 'About/'.$row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <div class="text-box">
                    <h2><?php echo $row['name']; ?></h2>
                    <small><?php echo $row['date']; ?></small>
                    <p><?php echo $row['description']; ?></p>
                    <span class="<?php echo $count % 2 == 0 ? 'left-container-arrow' : 'right-container-arrow'; ?>"></span>
                </div>
            </div>
            <?php
            // Increment counter
            $count++;
        }
        ?>
    </div>
    <?php
} else {
    // No skills found
    echo "No skills found.";
}


?>




</section>






<!-- contact secti0on -->

<section id="contact" class="contact">
    <div class="containercontact">
        <!-- Modified HTML code with changed class names -->
        <h2 class="new-section-text">Let's Connect</h2>

		<main class="row">
			
			<!--  *******   Left Section (Column) Starts   *******  -->

			<section class="col left">
           <h2>Get In Touch</h2>
			

                <?php
// Fetch dynamic data from the database
$query = "SELECT * FROM contact";
$result = mysqli_query($db, $query);

// Initialize variables to store fetched data
$phoneNumber = "";
$email = "";
$iframeSrc = "";

// Check if data was fetched successfully
if ($result) {
    // Fetching data row by row
    while ($row = mysqli_fetch_assoc($result)) {
        // Assigning fetched data to variables based on column names
        $phoneNumber = $row['number'];
        $email = $row['email'];
        $iframeSrc = $row['iframe'];
    }
}

// Generating dynamic HTML content
$contactInfoHTML = '
<div class="contactInfo">
    <div class="iconGroup">
        <div>
            <img src="img/img/call.png" width="50" height="50" alt="">
        </div>
        <div class="details">
            <span>Phone</span>
            <span>' . $phoneNumber . '</span>
        </div>
    </div>
    <div class="iconGroup">
        <div>
            <img src="img/img/email.png" width="50" height="50" alt="">
        </div>
        <div class="details">
            <span>Email</span>
            <span>' . $email . '</span>
        </div>
    </div>
    <div class="iconGroup">
        <div>
            <iframe src="' . $iframeSrc . '" width="350" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>';

// Output the dynamically generated HTML
echo $contactInfoHTML;
?>

			
</section>

			<section class="col right">
            <?php

// Handle form submission
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($db, $sql)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Send Message</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <section class="col right">
        <form class="messageForm" method="post">
            <div class="inputGroup halfWidth">
                <input type="text" name="name" required="required">
                <label>Your Name</label>
            </div>

            <div class="inputGroup halfWidth">
                <input type="email" name="email" required="required">
                <label>Email</label>
            </div>

            <div class="inputGroup fullWidth">
                <input type="text" name="subject" required="required">
                <label>Subject</label>
            </div>

            <div class="inputGroup fullWidth">
                <textarea name="message" required="required"></textarea>
                <label>Say Something</label>
            </div>

            <div class="inputGroup fullWidth">
                <button type="submit" name="submit">Send Message</button>
            </div>
        </form>
    </section>
</body>
</html>

				

			
			
			</section>


		</main>
	</div>



</section>























<footer class="footer-distributed">

    <div class="footer-left">
       
        <img src="img/img/logo.png" width="100" height="100" alt="" style="margin-left: 10%;">
       

        <p class="footer-links">
            <a href="#home">Home</a>
            |
            <a href="#about">About</a>
            |
            <a href="#timeline">Timeline</a>
            |
            <a href="#projects">Projects</a>
            |
            <a href="#skills">Skills</a>
            |
            <a href="#contact">Contact</a>
        </p>

       
    </div>
    <div class="footer-center">

       
        <table>
            <th> <img src="img/img/location2.png" height="40"width="40" alt=""></th>
            <th><p align="center" >Khulna,Bangladesh</p></th>
        </table>
        <table>
            <th> <img src="img/img/call2.png"height="40"width="50"  alt=""></th>
            <th> <p>+8801571421684</p></p></th>
        </table>
        <table>
            <th> <img src="img/img/emai2.png"height="40"width="50"  alt=""></th>
            <th><p><a href="tirthomonda.2001@gmail.com">tirthomonda.2001@gmail.com</a></p></th>
        </table>
       
    
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span> Thank you for visiting my Kingdome! </span>
            <strong> Your interest is greatly appreciated. If there's anything you'd like to know or discuss further, feel free to reach out. Have a wonderful day!  </strong> 
        </p>
    
        


<?php

// Fetch data from the database
$sql = "SELECT * FROM social_media_profiles";
$result = mysqli_query($db, $sql);

// Check if there are any rows in the result
if (mysqli_num_rows($result) > 0) {

    echo "<table>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<th>";
        echo "<td><img src='About/" . $row['img'] . "' alt='" . $row['alt'] . "' class='icon' onclick=\"window.open('" . $row['link'] . "')\" /></td>";
        echo "</th>";
    }

    echo "</table>";
} else {
    echo "0 results";
}


?>





    </div>
    <p class="footer-company-name" align ="center">Copyright © 2024 <strong><a href="#home">Tirtho Mondal</a></strong> All rights reserved</p>
</footer>


    <script src="script.js"></script>
    <script src="mixitup.min.js"></script>
</body>
</html>