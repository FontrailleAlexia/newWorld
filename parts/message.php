<?php
if($_MSG_WARNING != ""){?>
	<!-- Le code HTML pour afficher un avertissement -->
	<div class="alert alert-warning alert-dismissible alert-ajax" role="alert">
	  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  <?php echo $_MSG_WARNING;?>
	</div>
<?php }

if($_MSG_ERROR != ""){?>
	<!-- Le code HTML pour afficher une erreur -->
	<div class="alert alert-danger alert-dismissible alert-ajax" role="alert">
	  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <?php echo $_MSG_ERROR;?>
	</div>

<?php }

if($_MSG_INFO != ""){?>
	<!-- Le code HTML pour afficher une information -->
	<div class="alert alert-success alert-dismissible alert-ajax" role="alert">
	  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  <?php echo $_MSG_INFO;?>
	</div>
<?php }
?>