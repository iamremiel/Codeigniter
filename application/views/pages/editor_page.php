
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
                     <!--    <th>Start date</th> -->
                     <!-- <th>Salary</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($users as $row) {?>
              
                  <tr>
                  <td><input class="checkbox1"name="selector[]" type="checkbox" value="<?php echo $row['hash']; ?>"></td>
                  <td><img  style="max-width:100px;"class="circle responsive-img" src="<?php echo base_url().'uploads/'.$row['picture'];?>" alt="<?php echo $row['picture_thumb'];?>"></td>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['amount'];?></td>
                  <td>Kynd PH</td>
                  <td><a id="<?php echo $row['id'];?>"name="<?php echo $row['id'];?>" class="fancybox fancybox.ajax btn waves-effect waves-green white-text" href="<?php echo base_url('welcome/cruds/'.$row['hash'].'?id='.$row['id']);?>">View <i class="white-text fa fa-eye"></i></a>
                  </tr>
                  <?php   }
                     ?>
               </tbody>
            </table>
          </form>
         </div>
      </div>
   </div>
  
<script>
   $(document).ready(function(){ 
       $("#selectall").change(function(){
         $(".checkbox1").prop('checked', $(this).prop("checked"));
         });
   });
      /*    $(document).ready(function() {
            var table = $('#datatable').DataTable( {
              responsive: true
          } );
      } );*/
      
      /*$(document).ready(function(){
         $('#datatable').dataTable().makeEditable();
      });*/
       (function(window, document, undefined) {
      
        var factory = function($, DataTable) {
          "use strict";
      
          $('.search-toggle').click(function() {
            if ($('.hiddensearch').css('display') == 'none')
              $('.hiddensearch').slideDown();
            else
              $('.hiddensearch').slideUp();
          });
      
          /* Set the defaults for DataTables initialisation */
          $.extend(true, DataTable.defaults, {
            dom: "<'hiddensearch'f'>" +
              "tr" +
              "<'table-footer'lip'>",
            renderer: 'material'
          });
      
          /* Default class modification */
          $.extend(DataTable.ext.classes, {
            sWrapper: "dataTables_wrapper",
            sFilterInput: "form-control input-sm",
            sLengthSelect: "form-control input-sm"
          });
      
          /* Bootstrap paging button renderer */
          DataTable.ext.renderer.pageButton.material = function(settings, host, idx, buttons, page, pages) {
            var api = new DataTable.Api(settings);
            var classes = settings.oClasses;
            var lang = settings.oLanguage.oPaginate;
            var btnDisplay, btnClass, counter = 0;
      
            var attach = function(container, buttons) {
              var i, ien, node, button;
              var clickHandler = function(e) {
                e.preventDefault();
                if (!$(e.currentTarget).hasClass('disabled')) {
                  api.page(e.data.action).draw(false);
                }
              };
      
              for (i = 0, ien = buttons.length; i < ien; i++) {
                button = buttons[i];
      
                if ($.isArray(button)) {
                  attach(container, button);
                } else {
                  btnDisplay = '';
                  btnClass = '';
      
                  switch (button) {
      
                    case 'first':
                      btnDisplay = lang.sFirst;
                      btnClass = button + (page > 0 ?
                        '' : ' disabled');
                      break;
      
                    case 'previous':
                      btnDisplay = '<i class="fa fa-arrow-circle-o-left"></i>';
                      btnClass = button + (page > 0 ?
                        '' : ' disabled');
                      break;
      
                    case 'next':
                      btnDisplay = '<i class="fa fa-arrow-circle-o-right"></i>';
                      btnClass = button + (page < pages - 1 ?
                        '' : ' disabled');
                      break;
      
                    case 'last':
                      btnDisplay = lang.sLast;
                      btnClass = button + (page < pages - 1 ?
                        '' : ' disabled');
                      break;
      
                  }
      
                  if (btnDisplay) {
                    node = $('<li>', {
                        'class': classes.sPageButton + ' ' + btnClass,
                        'id': idx === 0 && typeof button === 'string' ?
                          settings.sTableId + '_' + button : null
                      })
                      .append($('<a>', {
                          'href': '#',
                          'aria-controls': settings.sTableId,
                          'data-dt-idx': counter,
                          'tabindex': settings.iTabIndex
                        })
                        .html(btnDisplay)
                      )
                      .appendTo(container);
      
                    settings.oApi._fnBindAction(
                      node, {
                        action: button
                      }, clickHandler
                    );
      
                    counter++;
                  }
                }
              }
            };
      
            // IE9 throws an 'unknown error' if document.activeElement is used
            // inside an iframe or frame. 
            var activeEl;
      
            try {
              // Because this approach is destroying and recreating the paging
              // elements, focus is lost on the select button which is bad for
              // accessibility. So we want to restore focus once the draw has
              // completed
              activeEl = $(document.activeElement).data('dt-idx');
            } catch (e) {}
      
            attach(
              $(host).empty().html('<ul class="material-pagination"/>').children('ul'),
              buttons
            );
      
            if (activeEl) {
              $(host).find('[data-dt-idx=' + activeEl + ']').focus();
            }
          };
      
          /*
           * TableTools Bootstrap compatibility
           * Required TableTools 2.1+
           */
          if (DataTable.TableTools) {
            // Set the classes that TableTools uses to something suitable for Bootstrap
            $.extend(true, DataTable.TableTools.classes, {
              "container": "DTTT btn-group",
              "buttons": {
                "normal": "btn btn-default",
                "disabled": "disabled"
              },
              "collection": {
                "container": "DTTT_dropdown dropdown-menu",
                "buttons": {
                  "normal": "",
                  "disabled": "disabled"
                }
              },
              "print": {
                "info": "DTTT_print_info"
              },
              "select": {
                "row": "active"
              }
            });
      
            // Have the collection use a material compatible drop down
            $.extend(true, DataTable.TableTools.DEFAULTS.oTags, {
              "collection": {
                "container": "ul",
                "button": "li",
                "liner": "a"
              }
            });
          }
      
        }; // /factory
      
        // Define as an AMD module if possible
        if (typeof define === 'function' && define.amd) {
          define(['jquery', 'datatables'], factory);
        } else if (typeof exports === 'object') {
          // Node/CommonJS
          factory(require('jquery'), require('datatables'));
        } else if (jQuery) {
          // Otherwise simply initialise as normal, stopping multiple evaluation
          factory(jQuery, jQuery.fn.dataTable);
        }
      
      })(window, document);
      
      $(document).ready(function() {
        $('#datatable').dataTable({
           // var table = $('#datatable').DataTable( {
            responsive: true,
          "oLanguage": {
            // "sStripClasses": "",
            "sSearch": "",
            "sSearchPlaceholder": "Enter Keywords Here",
            "sInfo": "_START_ -_END_ of _TOTAL_",
            "sLengthMenu": '<span class="rpp">Rows per page:</span><select class="browser-default">' +
              '<option value="10">10</option>' +
              '<option value="20">20</option>' +
              '<option value="30">30</option>' +
              '<option value="40">40</option>' +
              '<option value="50">50</option>' +
              '<option value="-1">All</option>' +
              '</select></div>'
          },
           // bAutoWidth: true
        });
      });
          
</script>