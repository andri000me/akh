<?php

echo anchor('imageupload', 'Upload Another File!');
echo "<br />";
echo "Total file teruplod ada: ".$total;
echo "<br />";
echo "Lihat hasilnya di folder doc";
echo '<pre>';
print_r($this->upload->get_multi_upload_data());
echo '</pre>';

?>
