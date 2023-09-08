         <footer class="sticky-footer" style="background-color: #a0a7ac; text-align: center;">

           <span style="line-height: 5; font-size: 12px;"><strong>Copyright © Synergic Softek Solutions PVT. LTD. 2018</strong></span>

        </footer>

    </body>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.select2').select2();
      $(".hide_show").click(function(){
        var menu = $(this).val();
        $.ajax({  
         type:"POST",  
         url:"<?php echo site_url("User_Login/menuset");?>",  
         data:"menu="+menu,
         success:function(data){  
            if(menu == 'stationery_menu'){
              //location.reload();
              window.location.href = '<?php echo base_url(); ?>index.php/User_Login/main';
            }else{
              window.location.href = '<?php echo base_url(); ?>index.php/User_Login/main';
            }
         }  
        });
      });
      
		});
	</script>

</html>