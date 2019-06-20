<?php
$targetFolder = '/home/y71ul2b2argw/public_html/portal.littleangelsowerri.com/storage/app/public';

$linkFolder = '/home/y71ul2b2argw/public_html/portal.littleangelsowerri.com/public/storage';

symlink($targetFolder, $linkFolder);

echo 'Symblink created!';

?>