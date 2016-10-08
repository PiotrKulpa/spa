<!--Login Page-->
<div class="container">
<br>
<br>
<br>
<br>
<br>
 <div class="jumbotron">
<h3 align="center">Zaloguj się do panelu zarządzania muzyką, wideo i zdjęciami</h3>

<?php echo form_open('admin', 'class="form-horizontal"'); ?>
  <div class="form-group">
    <label class="control-label col-sm-2" for="login">Login:</label>
    <div class="col-sm-10">
      <input type="text" name="login" class="form-control" id="login" placeholder="Wpisz login">
	  
	    <?php echo form_error('login', '<div class="alert alert-danger">', '</div>'); ?>
	  
    </div>
	
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Hasło:</label>
    <div class="col-sm-10"> 
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Wpisz hasło">
	  
	    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
	  
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Zaloguj</button>
    </div>
  </div>
</form>
</div>
</div>