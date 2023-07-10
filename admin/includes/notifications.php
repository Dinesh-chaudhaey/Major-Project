<script>
	$(document).ready(function(){
		setTimeout(function(){
			$("#message").hide("slow");
		}, 5000);
	});
</script>

<div id="message">
<?php
     if (isset($_REQUEST['msg']))
	 {
		 ?>
         	<div class="notification success png_bg">	
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
					<?php  
                        $messag=$_REQUEST['msg'];
                        echo $messag;
                    ?>
         		</div>
         	</div>
         <?php
	}               
?>  
</div>                  
    


