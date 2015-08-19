<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php if(isset($mens))
        {
          echo $mens;
          echo 'OK';
        }
    ?>
    <?=form_open_multipart('welcome/do_upload'); ?>
      <input type="file" name="userfile" size="20" />
      <br /><br />
      <input type="submit" value="upload" />
    </form>

  </body>
</html>
