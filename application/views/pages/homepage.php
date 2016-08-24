
<div class="container">
   <div class="row">
      <div id="admin" class="col s12">
         <div class="card material-table">
            <?php if($message==1):
               ?>
            <script type="text/javascript">  // Materialize.toast(message, displayLength, className, completeCallback);
               Materialize.toast('User Added!', 10000) // 4000 is the duration of the toast
            </script>
            <?php elseif($message==2):?>
            <script type="text/javascript">  // Materialize.toast(message, displayLength, className, completeCallback);
               Materialize.toast('User Updated!', 10000) // 4000 is the duration of the toast
            </script>
          <?php elseif($message==3):?>
            <script type="text/javascript">  // Materialize.toast(message, displayLength, className, completeCallback);
               Materialize.toast('User Already Exist!', 10000) // 4000 is the duration of the toast
            </script>
          <?php endif;?>
            <div class="table-header">
               <span class="table-title">REMZ Ternuhan System</span>
               <div class="actions">
                  <!-- <button id="add_users">Add Users</button> -->
                  <a id="btnnew"  href="<?php echo base_url('welcome/cruds/'.$hash);?>" class="fancybox fancybox.ajax waves-effect btn-flat nopadding"><i class="fa fa-user-plus"></i></a>
                  <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="fa fa-search"></i></a>
               </div>
            </div>
            <form action="<?php echo base_url('welcome/delete_multiple');?>" method="post">
            <table id="datatable">
               <thead>
                  <tr>
                     <th><input type="checkbox" id="selectall"name="lists"></th>
                     <th></th>
                     <th>Name</th>
                     <th>Amount Invested</th>
                     <th>Office</th>
                     <th></th>
                     <th></th>
                     <!--    <th>Start date</th> -->
                     <!-- <th>Salary</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($users as $row) {?>
              
                  <tr>
                  <td><input class="checkbox1"name="selector[]" type="checkbox" value="<?php echo $row['hash']; ?>"></td>
                  <td><img  class="circle responsive-img" src="<?php echo base_url().'uploads/'.$row['picture'];?>" alt="<?php echo $row['picture_thumb'];?>"></td>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['amount'];?></td>
                  <td>Kynd PH</td>
                  <td><a id="<?php echo $row['id'];?>"name="<?php echo $row['id'];?>" class="fancybox fancybox.ajax btn waves-effect waves-green white-text" href="<?php echo base_url('welcome/cruds/'.$row['hash'].'?id='.$row['id']);?>">View <i class="white-text fa fa-eye"></i></a>
                  <td><?php echo anchor('welcome/delete/'.$row['hash'].'?deletes='.$row['id'], 'Delete <i class="white-text fa fa-trash"></i>', array('class' => 'waves-effect waves-light btn red white-text', 'onClick' => "return confirm('Are you sure you want to delete?')"));?></td>
                  </tr>
                  <?php   }
                     ?>
               </tbody>
            </table>
            <button type="submit" name="deletem"class="waves-effect waves-light btn red white-text">Delete Selected <i class="white-text fa fa-trash"></i></button>
          </form>
         </div>
      </div>
   </div>


     <!-- Modal Trigger -->
  <a style="display:none;"id="rem"class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h5>Please Complete the Form First</h5>
      <hr></hr>
      <p></p>
      <form id="frmvalid"action="<?php echo base_url('welcome/rem_ctrl');?>" method="post">
      <label>Enter your Verification Code:</label>
      <input type="text" name="code" id="code">
     
      
    </div>
    <div class="modal-footer">
     <button class="btn waves-effect waves-light" type="submit">Submit</button>
      <!-- <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a> -->
    </div>
    </form>
  </div>
          
<script>
   var base_url = "<?php echo base_url();?>";
   $(document).ready(function(){ 
      $('.modal-trigger').leanModal({
      dismissible: false, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
   //   ready: function() { alert('Ready'); }, // Callback for Modal open
     // complete: function() { alert('Closed'); } // Callback for Modal close
    }
  );
    $('#rem')[0].click(); // Works too!!!


      $("#frmvalid").validate({
      rules: {
      code: {
        required: true,
        minlength: 3,
        remote: {
        url: base_url + "welcome/check_if_exist/",
        type: "post",
        // data: {
        //   email: function() {
        //     return $( "#email" ).val();
        //   }
        // }
      }
      }
      },
            messages: {
                code: {
                    remote: "code Does not EXIST!"
                }
            }
        });
  
   });

</script>