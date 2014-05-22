<?php
echo anchor('imageupload', 'Upload Another File!');
 echo "Lihat hasilnya di folder" ;
                echo '<pre>';
                print_r($this->upload->get_multi_upload_data());
                echo '</pre>';
                
              
?>
