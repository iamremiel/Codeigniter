

<script>
      $().ready(function(){
          $(".fancybox").fancybox();
          $("#frmRegistrar").validate({
            rules: {
        first_name: {
          required: true,
          minlength: 2
        },
        last_name: {
          required: true,
          minlength: 2
        },
        }
          });
    });
      
    </script>