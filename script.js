
/* GALLERY/HOMEPAGE INITIALIZATION: */

// Initializing HTML element variables:
let detailsWindow = document.getElementById("scanDetailsWindow"); // <- inspector window; comes up when an image is clicked
let detailImage = document.getElementById("detailImage"); // <- image displayed within the inspector window
let dateText = document.getElementById("dateText"); // <- date scan  was captured; displayed in inspector window
let locationText = document.getElementById("locationText"); // <- approximate location scan was captured; displayed in inspector window
let dimensionsText = document.getElementById("dimensionsText"); // <- dimensions of image in pixels; displayed in inspector window
let closeWindow = document.getElementById("closeWindow"); // <- text element that closes inspector window when clicked; displayed in inspector window
let downloadScanLink = document.getElementById("download"); // <- a href element that downloads currently displayed image; displayed in inspector window

// Setting the nav background to a random scan:
let randomScanID = Math.floor(Math.random() * 74);
let navBackgroundFilePath = "url('imgs/scan" + randomScanID + ".jpg')";
let navElement = document.getElementById("nav");
navElement.style.backgroundImage = navBackgroundFilePath;

// closeWindow: closes the window when text element reading 'close' within the inspector window is clicked
closeWindow.addEventListener("click",
    function() {
        detailsWindow.style.visibility = "hidden"; // <- "closing" the window just means toggling off its visibility. Window is hidden by default and becomes visible when an image is clicked
    }
)

/* SCAN/IMAGE GRID: */

// Getting all .scan class HTML elements and adding click event listeners (displays inspector window with image attributes when images elements in the grid are clicked):
const scanElements = document.querySelectorAll(".scan");
for (const scanElement of scanElements) {
    scanElement.addEventListener("click",
        function() {

            // Getting scan attributes to display from invisible elements in index.php (created during foreach scan loop):
            let id = scanElement.id;
            let imagePath = document.getElementById(id+"_image_path").textContent;
            let location = document.getElementById(id+"_location").textContent;
            let date = document.getElementById(id+"_date").textContent;
            let dimensions = document.getElementById(id+"_dimensions").textContent;

            // Sending attributes to inspector window:
            setDetailsWindow ( imagePath, location, date, dimensions );
            let inspectorBackgroundImage = document.querySelector(".expandedViewContainerGallery"); // <- image currently being displayed is overlaid over the background of the inspector window and color burn blended to create a unique background for each image
            if (inspectorBackgroundImage) {
                // set the background image to the currently displayed image file path & set it's size to be a fraction of it's actual size (as opposed to the square cropped version in the gallery grid):
                inspectorBackgroundImage.style.backgroundImage = `url('${imagePath}')`;
                inspectorBackgroundImage.style.width = detailImage.naturalWidth*0.28 + "px";
            }

            // Update download image link:
            downloadScanLink.download = "scan"+id+".JPG"; // <- file name when downloaded
            downloadScanLink.href = imagePath; // <- file path to image
            
            // Open window (set visible):
            detailsWindow.style.visibility = "visible";

        }
    )
}

/*  setDetailsWindow: Sets elements within the inspector window that display information about the scan to appropriate values
    param imagePath     ->      String: image to be displayed in the window
    param location      ->      String: location the scan was captured (approximate)
    param date          ->      String: date the image was taken (Format ex: March 10, 2025)
    param dimensions    ->      String: dimensions of the image in pixels (Format ex: 2000 x 2000px)
*/
function setDetailsWindow ( imagePath, location, date, dimensions ) {
    detailImage.src = imagePath;
    locationText.textContent = location;
    dateText.textContent = date;
    dimensionsText.textContent = dimensions;
}