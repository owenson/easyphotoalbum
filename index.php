<!DOCTYPE html>
<html>
<head>
    <link href="lightbox2/css/lightbox.css" rel="stylesheet">
    <style>
        body {
            width: 960px;
            margin: 0 auto;
            text-align: center;
        }
        img.gallery {
            padding: 5px;
        }
        div a {
            color: white;
        }
    </style>
    <title>Photos</title>
</head>
<body>


<?php

// DIR Structure:
// thmbs = thumbnails
// views = larger ones when user clicks on it
// prints = originals
// 
// pictures sorted by file modification time (in the thmbs folder)
// (in zsh) you can use glob *(Om) to glob but order in ascending order of modification time

chdir("thmbs");
$files = glob("*.{jpg,jpeg,png,gif}", GLOB_BRACE);
chdir("..");
usort($files, function($a, $b) {
        return filemtime('thmbs/'.$a) > filemtime('thmbs/'.$b);
});

for($i=0; $i<count($files); $i++) {
    $f = $files[$i];
    $sz = getimagesize("thmbs/".$f);
    print "<a href='views/$f' 
              data-lightbox='album' 
              data-title='<a href=\"prints/$f\">Download Print Version</a>'><img class='gallery' data-original='thmbs/$f' width='{$sz[0]}' height='{$sz[1]}'></a>";
}
?>

<script src="lightbox2/js/lightbox-plus-jquery.min.js"></script>
<script src="jquery.lazyload.min.js"></script>
<script>
    $('img').lazyload({
        effect: 'fadeIn', 
            threshold: 200
    });
    lightbox.option({
      'resizeDuration': 100,
      'wrapAround': true,
      'fadeDuration': 200
    });
</script>
</body>
</html>
