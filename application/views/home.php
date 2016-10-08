    <!--Main Page-->
	<!--Home-->
    <div class="container-fluid home-bg">
      <div id="home" class="container">
        <img class="img-responsive" src="<?php echo base_url('assets/images/home.jpg'); ?>" alt="home-image">
      </div>
    </div>
	
    <!--O nas-->
    <div id="onas" class="container-fluid about-bg">
      <div class="container">
        <div class="row">
		  <div class="col-sm-5">
		    <h1 id="padding50top">O nas</h1>
		    <h3>
		      Jako doświadczony zespół muzyczny wykonujemy utwory z dowolnie wybranego przez Państwa repertuaru.Możemy naszą grą uświetnić spotkania branżowe, bankiety i konferencje, jak też zapewnić doskonałą zabawę podczas uroczystości rodzinnych. The Stringers to idealny zespół muzyczny na wesele. Uczestnicząc w wielu zabawach weselnych doskonale poznaliśmy gusta gości, którzy w tak radosnych chwilach oczekują skocznej, tanecznej muzyki.
            </h3>
			<div id="image-nasza"><img class="img-responsive" src="<?php echo base_url('assets/images/nasza.jpg'); ?>" alt="onas-image"></div>
		  </div>
		  <div class="col-sm-7"><img class="img-responsive pull-right" src="<?php echo base_url('assets/images/onas.png'); ?>" alt="onas-image"></div>
        </div>
      </div>
    </div>
	
	<!--Muzyka-->
    <div id="muzyka" class="container-fluid music-bg" ng-controller="MusicCtrl">
      <div class="container">
        <div class="row">
		  <div class="col-sm-5">
			<div><img class="img-responsive pull-left" src="<?php echo base_url('assets/images/naszamuzyka.jpg'); ?>" alt="muzyka"></div>
		  </div>
		 
          <div class="col-sm-7">
		    <img class="img-responsive" src="<?php echo base_url('assets/images/muzyka.jpg'); ?>" alt="onas-image">
		    

		    <table class="table table-condensed">
              <thead>
			    <tr>
				  <th>Tutuł</th>
				  <th>Plik</th>
			    </tr>
              </thead>
              <tbody>
              
			    <tr ng-repeat="x in names | limitTo:-4 | orderBy:'-date'">
                  <td>{{x.title | myFormat}}</td>
                  <td>
				    <audio controls>
                      <source src="empty.ogg" type="audio/ogg">
                      <source ng-src="{{x.src | trustAsResourceUrl}}" type="audio/mpeg">
                      Your browser does not support the audio element.
                    </audio> 
                  </td>
			    </tr>
              </tbody>
            </table>
		  </div>
	    </div>
      </div>
      
    </div>
	
  <!--Galeria-->
  <div id="galeria" class="container-fluid gallery-bg" ng-controller="PhotosCtrl">
    <div class="container">
    <img class="img-responsive pull-right" src="<?php echo base_url('assets/images/galeria.jpg'); ?>" alt="galeria">
      <div class="row">
		  <div class="col-sm-7">
		  
		    <!-- Lacza do galerii-->
		    <div  ng-repeat="x in names | limitTo:-6 | orderBy:'-date'" style="display: inline;">
		      <a href="{{x.src}}" data-lightbox="wesele">
		        <img ng-src="{{x.thumb}}" width="30%" class="img-thumbnail img-responsive">
		      </a>
		    </div>
		  </div>
		  
		  <div class="col-sm-5"><img class="img-responsive pull-right" src="<?php echo base_url('assets/images/galeria-bg.jpg'); ?>" alt="onas-image"></div>
      </div>
    </div>
  </div>
  
  <!--Wideo-->
  <div id="wideo" class="container-fluid video-bg" ng-controller="VideoCtrl">

    <div class="container">
      <img class="img-responsive pull-right" src="<?php echo base_url('assets/images/wideo.jpg'); ?>" alt="galeria">
		<div class="row">
		  <div class="col-sm-5">
			<img class="img-responsive pull-right" src="<?php echo base_url('assets/images/wideo-bg.jpg'); ?>" alt="onas-image">
		  </div>
		  
		  <div class="col-sm-7">
		    <div class="pull-right">
			
		      <!-- Lacza do wideo-->
              <div ng-repeat="x in names  | limitTo:-3 | orderBy:'-date'">
              <iframe class="pull-right" width="480" height="270" ng-src="{{x.src | trustAsResourceUrl}}" frameborder="0"></iframe>
              </div>
		    </div>
		  </div>
		</div>
    </div>
  </div>
  
  <!--Kontakt-->
  
  <div id="kontakt" class="container-fluid contact-bg">
    <div class="container">
      <img class="img-responsive" src="<?php echo base_url('assets/images/kontakt.jpg'); ?>" alt="galeria">
	    
		<!--Formularz kontaktowy-->
		
		<?php echo form_open('contactform', 'class="form-horizontal"'); ?>
		  <div class="form-group">
			<label for="myInput">Adres E-mail:</label>
			<input type="email" name="sender" class="form-control" id="myInput">
			<?php echo form_error('sender', '<div class="alert alert-danger">', '</div>'); ?>
		  </div>
		  <div class="form-group">
			<label for="myInput">Zapytanie:</label>
			<textarea name="sender_message" rows="5" class="form-control" id="myInput"></textarea>
			<?php echo form_error('sender_message', '<div class="alert alert-danger">', '</div>'); ?>
		  </div>
		  
		  <button type="submit" class="btn btn-default">Prześlij</button> 
		</form>
		<br>
		<?php echo $this->session->flashdata('msg'); ?>		
    </div>
  </div>