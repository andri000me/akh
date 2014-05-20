<html>
<head>
   <title>Upload Form</title>
</head>
<body>
 
   <?php echo $error;?>
    
   <?php echo form_open_multipart('multiupload/do_upload');?>
      <!-- INPUT FILE UPLOAD dibuat "multiple" -->
      <input type="file" name="userfile[]" size="20" multiple />
    
      <br /><br />
       
      <input type="submit" value="upload" />
    
   </form>
    
</body>
</html>