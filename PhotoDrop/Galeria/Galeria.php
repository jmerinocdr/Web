<html>
<link rel="stylesheet" href="css.css">
<div class="grid-gallery">
<?php
foreach (glob("G:/PhotoDrop/*/*.JPG") as $filename) { 
    
    
    echo '<a class="grid-gallery__item" href="#">';
        $image = file_get_contents($filename);
        $image_codes = base64_encode($image);
        echo '<img class="grid-gallery__image" height="200px" loading="lazy" src="data:image/jpg;charset=utf-8;base64,'.$image_codes.'" />';
    echo '</a>';
    

    /*
    $image = file_get_contents($filename);
    $image_codes = base64_encode($image);
    echo '<img height="200px" loading="lazy" src="data:image/jpg;charset=utf-8;base64,'.$image_codes.'" />';
    */
}
?>
</div>
<script src="lazyload.js"></script>
<script>
lazyload();
</script>
</html>