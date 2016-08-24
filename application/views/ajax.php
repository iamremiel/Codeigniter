<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<?php 
   if (empty($edit_user)):
   //     echo "string";
   ?>

<form class="form2"id="frmadd" name="frmadd"action="<?php echo base_url('welcome/cruds/'.$hash);?>" method="post" enctype="multipart/form-data">
   <h5 id="responses">Add New Participant</h5>
   <div class="row">
   <div class="col s12 m12">
        <label>Upload Image</label>
        <input style="max-width:200px;"type="file" id="userfile" name="userfile" accept="image/*" size="20" oninvalid="setCustomValidity('Please, blah, blah, blah ')" /><br></br>
   </div>
      <div class="input-fiel col s12 m5">
         <label for="first_name">First Name</label>
         <input require id="first_name" name="first_name"type="text" class="validate" >
      </div>
      <div class="input-fiel col s12 m5">
         <label for="last_name">Last Name</label>
         <input placeholder="asdasdasd"require id="last_name" name="last_name" type="text" class="validate" >
      </div>
      <div class="input-fiel col s12 m2">
         <label>Extension</label>
         <input require name="extension"placeholder="Extension"class="validate"list="extensions" >
         <datalist id="extensions">
            <option value="Jr">
            <option value="Sr">
            <option value="II">
            <option value="III">
            <option value="IV">
         </datalist>
      </div>
      <div class="input-fiel col s12 m5">
      <label for="amount">Email</label>
      <input  require type="email" name="email" id="email" class="validate" >
      </div>
      <div class="input-fiel col s12 m5">
      <label for="amount">Amount</label>
      <input  require type="number" min="0" step="1" name="amount"id="amount" class="validate" >
      </div>
   </div>
   <input name="add"id="add"class="btn waves-effect waves-light" type="submit" value="Submit">
</form>
<?php else:?>


<form class="form1"id="frmadd" name="frmadd"action="<?php echo base_url('welcome/cruds/'.$hash);?>" method="post" enctype="multipart/form-data">  
<h5 id="responses">Add New Participant</h5>
<div class="row">

<?php 
   $str = $edit_user['name'];
   $names = explode(" ",$str);?>

<div class="input-fiel col s12 m12">
<img src="<?php echo base_url().'uploads/'.$edit_user['picture_thumb']?>" alt="<?php echo $edit_user['picture_thumb']?>">
</div>

<div class="input-fiel col s12 m5">
<label for="first_name">First Name</label>
<input require readonly id="first_name" name="first_name"type="text" class="validate" value="<?php echo $names[0]?>">
</div>
<div class="input-fiel col s12 m5">
<label for="last_name">Last Name</label>
<input readonly placeholder="asdasdasd"require id="last_name" name="last_name" type="text" class="validate" value="<?php echo $names[1]?>">
</div>
<div class="input-fiel col s12 m2">
<label>Extension</label>
<input require name="extension"placeholder="Extension"class="validate"list="extensions" value="<?php echo $names[2];?>">
<datalist id="extensions">
<option value="Jr">
<option value="Sr">
<option value="II">
<option value="III">
<option value="IV">
</datalist>
</div>
<table style="max-width:400px;"class="bordered highlight">
<thead>
<tr>
<th data-field="name">Amount Invested</th>
<th data-field="price">Date</th>
</tr>
</thead>
<tbody>
<?php foreach ($invested as $invest) {
   ?>
<tr>
<td><?php echo $invest['amount']; ?></td>
<td><?php $date = $invest['created_date'];
    $mydate = strtoTime($date);
    echo $printdate = date('F d, Y', $mydate);?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="input-fiel col s12 m3">
<label for="amount">Total Amount Invested</label>
<input readonly  type="number" name="amount"id="amount" class="validate" value="<?php echo $invested_sum['amount']?>">
</div>
<div class="input-fiel col s12 m3">
<label for="amount-add">Add Investment</label>
<input require type="number" name="amount_add"id="amount_add" class="amt-add validate">
</div>
</div>
<input name="edit"id="edit"class="btn waves-effect waves-light" type="submit" value="Submit">
</form>
<?php endif;?>
<script>
   function amt_add(){
   
     $('.amt-add').slideToggle();
   }
/*   document.getElementById("file").onchange = function() {
    document.getElementById("form").submit();
};*/
    $().ready(function(){
      var base_url = "<?php echo base_url();?>";
/*       jQuery.validator.addMethod("checkExists", function(value, element)
{
    var inputElem = $('#frmadd :input[name="email"]'),
        data = { "email" : inputElem.val() },
        eReport = ''; //error report

    $.ajax(
    {
        type: "POST",
        async: false,
        url: site_url + 'welcome/if_registered',
        dataType: "json",
        data: data, 
        success: function(returnData)
        {
            if (returnData!== 'true')
            {
              return '<p>This email address is already registered.</p>';
            }
            else
            {
               return true;
            }
        },
        error: function(xhr, textStatus, errorThrown)
        {
            alert('ajax loading error... ... '+url + query);
            return false;
        }
    });

}, '');*/

  /*    jQuery.validator.addMethod("checkExists", function(value, element) {
        return this.optional(element) || value != "bob";
      }, "Please specify the correct domain for your documents");
    */
jQuery.validator.addMethod("checkExists", 
    function(value, element) {
        var result = false;
        $.ajax({
            type:"POST",
            async: true,
            url: base_url + "welcome/if_registered",
            data: JSON.stringify(value),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(msg) {
                result = (msg === "true") ? false : true;
            }
        });
        return result;
    }, 
    "Username Already Exists."
);

     $("#frmadd").validate({
          rules: {
      first_name: {
        required: true,
        minlength: 2
      },
      email: {
        required: true,
        email: true,
        // email: "email",
        // checkExists:true,
        // remote: "val.php",type: "post"
        remote: {
        url: base_url + "welcome/if_registered/",
        type: "post",
        // data: {
        //   email: function() {
        //     return $( "#email" ).val();
        //   }
        // }
      }
    },
      last_name: {
        required: true,
        minlength: 2
      },
      userfile: {
        required:true,
        accept: "image/*"
      }
      },
            messages: {
                email: {
                    required: "Please Enter Email!",
                    email: "This is not a valid email!",
                    remote: "Email already in use!"
                },
                userfile:{ accept:"Image Only"}
            }
        });
      $("#frmimage").validate({
        rules: {
        file:{
        required: true,
        accept: "image/*"
      }
      }
        });
    }); 
    // $.validator.messages.required = 'required';
   
</script>