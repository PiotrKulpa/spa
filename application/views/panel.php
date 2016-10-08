    <!--Login Page-->
    <div class="container" ng-app="Zespol">
      <div id="padding50top"></div>
      <div id="padding50top"></div>
      <div class="alert alert-warning">
        Pamiętaj, aby się wylogować po skończonej pracy!
      </div>
	  <!--Logout button-->
      <a href="<?php echo base_url('index.php/admin/logout'); ?>" class="btn btn-primary pull-right">Wyloguj</a>
	  
	  <!--Menu-->
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#music-manage">Muzyka</a></li>
        <li><a data-toggle="tab" href="#photos-manage">Zdjęcia</a></li>
        <li><a data-toggle="tab" href="#videos-manage">Wideo</a></li>
      </ul>
	  
      <!--Content-->
      <div class="tab-content">
	  
	    <!--Dodaj muzykę-->
        <div id="music-manage" class="tab-pane fade in active">
	      <div class="jumbotron">
            <h3>Dodaj plik z muzyką</h3>
			<!--Form-->
            <?php echo form_open_multipart('admin/addmusic', 'class="form-inline"');?>
            <div class="form-group">
              <input  type="file" name="userfile" multiple=""/>
            </div>
            <div class="form-group">
              <input class="btn btn-success btn-lg" type="submit" value="Dodaj plik" />
            </div>
            
            <?php if(isset($message)){echo $message;}?>
              <br>
              <br>
            </form>
          </div>

          <h3>Usuń pliki z muzyką</h3>

          <div class="post"  ng-controller="MusicCtrl">
		    
			<!-- Wersja dla php - ciezki zapis przy przesyłaniu danych z bazy do widoku
		    <?php //foreach ($posts as $id => $title) : ?>
            <h6 class="post-title"><?php //echo $title; ?> 
		    <?php //echo $id; ?>
		    <?php //echo '<img src="http://localhost/codeigniter/app01/uploads/'.$title.'" width=200px>'?>
		    <?php //echo '<a href="http://localhost/codeigniter/app01/delete/image/'.$id.'">Usuń</a>'?>
		    </h6>
            <?php //endforeach; ?>
		
		-->
		
		    <table class="table table-striped">
		      <th>Tytuł:</th>
		      <th></th>
		      <tr ng-repeat="x in names">
			    <td>{{ x.title }}</td>
			    <td><a href="<?php echo base_url('index.php/admin/deletemusic/{{ x.id }}'); ?>" class="btn btn-danger pull-right">Usuń</a></td>
		      </tr>
		    </table>
		
          </div>

	  
	<hr>
      
        </div>
		
		<!--Dodaj zdjęcia-->
        <div id="photos-manage" class="tab-pane fade">
          
	      <div class="jumbotron">
            <h3>Dodaj nowe zdjęcie</h3>

            <?php echo form_open_multipart('admin/addphoto', 'class="form-inline"');?>

            <div class="form-group">
              <input  type="file" name="userfile_photo" size="20" multiple=""/>
            </div>
            <div class="form-group">
              <input class="btn btn-success btn-lg" type="submit" value="Dodaj plik" />
            </div>

           <?php if(isset($photo_message)){echo $photo_message;}?>
   <br>
   <br>
            </form>
          </div>
		  <hr>
		  <h3>Usuń zdjęcia</h3>

          <div class="post" ng-app="Galeria-test" ng-controller="PhotosCtrl">
		    
		    <table class="table table-striped">
		      <th>Tytuł zdjęcia:</th>
		      <th>Podgląd:</th>
		      <th></th>
		      <tr ng-repeat="x in names | orderBy:'-date'">
			    <td>{{ x.title }}</td>
			    <td><img src="{{ x.src }}" width=200px></td>
			    <td><a href="<?php echo base_url('index.php/admin/deletephoto/{{ x.id }}'); ?>" class="btn btn-danger pull-right">Usuń</a></td>
		      </tr>
		    </table>
		
          </div>

	  
	<hr>
		  
        </div>
		
		<!--Dodaj wideo-->
        <div id="videos-manage" class="tab-pane fade">
		<?php echo form_open('admin/addvideo');?>
		<div class="jumbotron">
          <h3>Dodaj wideo z Youtube</h3>
	  
	      <div class="form-group">
            <label for="usr">Tytuł:</label>
            <input type="text" name="videotitle" class="form-control" id="usr">
            <?php echo form_error('videotitle', '<div class="alert alert-danger">', '</div>'); ?>
          </div>
          <div class="form-group">
            <label for="pwd">Kod Youtube:</label>
            <input type="text" name="videocode" class="form-control" id="pwd">
            * Kod Youtube to ostatnie cyfry i litery z linka (znajdują się po znaku v=)
            <?php echo form_error('videocode', '<div class="alert alert-danger">', '</div>'); ?>
          </div>
		  <button type="submit" class="btn btn-default">Dodaj</button>
		  <?php if(isset($video_message)){echo $video_message;}?>
		  </form>
		  </div>
		  
		  <hr>
		  <h3>Usuń wideo</h3>

          <div class="post" ng-app="Galeria-test" ng-controller="VideoCtrl">
		    
		    <table class="table table-striped">
		      <th>Tytuł wideo</th>
		      <th></th>
		      <tr ng-repeat="x in names | orderBy:'-date'">
			    <td>{{ x.title }}</td>
			    <td><a href="<?php echo base_url('index.php/admin/deletevideo/{{ x.id }}'); ?>" class="btn btn-danger pull-right">Usuń</a></td>
		      </tr>
		    </table>
		
          </div>
		  
        </div>
    
      </div>
    </div>