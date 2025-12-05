<?php

    // Getting all scans + their attributes from SQL DB ( id, image_path, location, date, dimensions )
    $conn = new PDO("sqlite:database.sqlite");
    $query = " SELECT * FROM images; ";
    $result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wellington Street Scans - Gallery</title>
        <meta charset="UTF-8">
        <meta name="description" content="Library of urban scans taken in Wellington, NZ">
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav id="nav">
            ❇&emsp;<a href="index.php">GALLERY</a>&emsp;//&emsp;
            <a href="about.php">ABOUT</a>&emsp;//&emsp;
            <a href="contact.php">CONTACT</a>&emsp;❇
        </nav>
        
         <div id="scanContainer">
            <!-- Expanded view that opens when an image is clicked: -->
            <div class="expandedViewContainerGallery" id="scanDetailsWindow">
                <div class="inland-block"><img src="imgs/scan13.jpg" id="detailImage"></div>
                <div class="inland-block"><ul>
                    <!-- Location, date, and dimensions text. Updates when an image is clicked: -->
                    <li id="locationText">Taranaki St. & Buckle St.</li>
                    <br><li id="dateText">October 12th, 2025</li>
                    <br><li id="dimensionsText">2560 × 4416px</li>
                    <!-- Link to download image: -->
                    <li><br><br><a download="custom-filename.jpg" href="/path/to/image" id="download">Download</a></li>
                    <!-- Licensing information: -->
                    <li id="licenseText"><br>&#169; Free for use with attribution:<br><a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International</a></li>
                    <!-- Closes window when clicked: -->
                    <li><br><br><div id="closeWindow">Close Window</div></li>
                </ul></div>
                
            </div>
            <?php  
            
                foreach($result as $row) {
                    
                    // All rows of data in table:
                    $id =           $row["id"]; // <- increments starting from 0
                    $imagePath =    $row["image_path"]; // <- path ex: imgs/scan0.JPG
                    $location =     $row["location"]; // <- approximate location within WGTN scan was captured
                    $date =         $row["date"]; // <- format ex: March 10th, 2025
                    $dimensions =   $row["dimensions"]; // <- in pixels. Format ex: 2000 x 2000px

                    ?> 
                        <!-- Individual image scan element: -->
                        <img src="<?php echo $imagePath ?>" class="scan" id="<?php echo $id ?>"/>
                        <!-- Hidden elements (used by script.js): -->
                        <p hidden id="<?php echo "{$id}_image_path" ?>"><?php echo "{$imagePath}" ?></p>
                        <p hidden id="<?php echo "{$id}_location" ?>"><?php echo "{$location}" ?></p>
                        <p hidden id="<?php echo "{$id}_date" ?>"><?php echo "{$date}" ?></p>
                        <p hidden id="<?php echo "{$id}_dimensions" ?>"><?php echo "{$dimensions}" ?></p>

                    <?php
                }
            
            ?>
         </div>
         <script src="script.js"></script>
    </body>
</html>