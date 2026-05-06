<?php
    include "include/navigationheader.php";
    include "time.php";
?>
<div class="content-wrapper" style="padding-top: 70px">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
			<div class ="card" id="index-color">
				 <div class="card-header">
					<div class="d-flex align-items-center">
					  <button type="button" onclick="history.back()" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
					  <h3 class="card-title w-100"><img src="img/send.png" height="24px" width="24px" id="icon-img-shadow"> Sent</h3>
					</div>
				</div>
			</div>
          <?php
          include "alert.php";
          ?>
          <div class="card">
            <div class="card-header" id="card-header1">
              <div class="d-flex align-items-center">
                <h3 class="card-title"><i class="fas fa-th-list"></i> Type of Sent</h3>
              </div>
            </div>
            <div class="card-body p-1">
              <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                  <?php
                      $check = mysqli_query($conn, "SELECT * FROM sch_selectstudents WHERE studid='".$row['id']."' AND status='1'");
                      $rowstud=mysqli_fetch_assoc($check);

                      if(!empty($rowstud)){
                        $disabled = 'enabled';
                      }else{
                        $disabled = 'disabled';
                      }
                      ?>
                  <button class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="false" <?php echo $disabled?>>
                  <?php 
                    if($disabled == 'disabled'){
                  ?>
                 <i class="click fas fa-exclamation-circle" id="schoffice-color"></i>
                  <?php
                  }
                  ?> 
                  Scholarship Office</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Registrar Office</button>
                </li>
              </ul>
              <div class="tab-content" id="custom-content-below-tabContent">
                <!-- Scholarship Office -->
                <div class="tab-pane fade" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                  <div class="mailbox-controls">
                    <div class="btn-group" style="border: 1px solid #d8dada; color:  #d6d6d6; border-radius:3px; padding:8px;">
                      <input  type="checkbox" class =" pl-2"name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"/>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="delete_files btn btn-default btn-sm" data-id="<?php echo $row['id'];?>"><i class="far fa-trash-alt"></i></button>
                    </div>
                    <div class="btn-group">
                        <button type="button" onclick="location.href='sch_office.php'" class="btn btn-default btn-sm"><i class="fas fa-pen"></i></button>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="sent_table" class="table table-hover">
                      <tbody>
                      <?php
                        $files= mysqli_query($conn,"SELECT * FROM sch_files WHERE studid='".$row['id']."' GROUP BY date");
                        $check=true;
                        while($rowfiles=mysqli_fetch_assoc($files)){
                          $check=false;
                      ?>
                      <tr id="<?php echo $rowfiles['id'];?>">
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" class="checked" value="<?php echo $rowfiles['id'];?>" name="select">
                            <label for="check2"></label>
                          </div>
                        </td>
                        <td class="mailbox-name"><a href="view_sentfiles.php?schfile=<?php  echo $rowfiles['studid']; ?>&schname=<?php echo $rowfiles['sch_name'];?>&date=<?php echo $rowfiles['date'];?>"><?php echo $rowfiles['sch_name'];?></a></td>
                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                        <td class="mailbox-date"><?php echo Time_Convert($rowfiles['date']);?></td>
                      </tr>
                      <?php
                        }if($check){
                          echo "<td class='text-center'>Empty</td>";
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Registrar Office -->
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                  <div class="mailbox-controls py-2">
                      <div class="btn-group" style="border: 1px solid #d8dada; color:  #d6d6d6; border-radius:3px; padding:8px;">
                        <input  type="checkbox" class =" pl-2"name="checkall" id="checkall" onClick="check_uncheck_checkbox1(this.checked);"/>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="delete_files btn btn-default btn-sm" data-id="<?php echo $id;?>"><i class="far fa-trash-alt"></i></button>
                      </div>
                      <div class="btn-group">
                          <button type="button" onclick="location.href='rgstrar_office.php'" class="btn btn-default btn-sm"><i class="fas fa-pen"></i></button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="sent_table" class="table table-hover">
                        <tbody>
                        <?php
                          $request= mysqli_query($conn,"SELECT * FROM request WHERE studno='$id'");
                          $check1=true;
                          while($rowrequest=mysqli_fetch_assoc($request)){
                            $check1=false;
                        ?>
                        <tr id="<?php echo $rowrequest['id'];?>">
                          <td>
                            <div class="icheck-primary">
                              <input type="checkbox" class="checked" value="<?php echo $rowrequest['id'];?>" name="select1">
                              <label for="check2"></label>
                            </div>
                          </td>
                          <td class="mailbox-name"><a href="view_sentrequest.php?requestid=<?php  echo $rowrequest['id'];?>"><?php echo $rowrequest['student_request'];?></a></td>
                          <td class="mailbox-attachment"><?php if($rowrequest['status'] == 0){echo "Pending..";}else if($rowrequest['status'] == 1){echo "Recieve";}?></td>
                          <td class="mailbox-date"><?php echo Time_Convert($rowrequest['date']);?></td>
                        </tr>
                        <?php
                          }if($check1){
                            echo "<td class='text-center'>Empty</td>";
                          }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<script>
    $(function () {
    $("#sent_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(document).on('click', '.delete_files', function(){
    var studid = $(this).data('id');
    var id = [];

  $(".checked").each(function(){
      if($(this).is(":checked")){
          id.push($(this).val())
      }
  });

  id = id.toString();

  var action = "delete_all";

      $.ajax({
      url:"action.php",
      method:"POST",
      data:{action:action,id:id,studid:studid},
      success:function(data)
      {
        location.reload();
          var ele=document.getElementsByName('select');  
              for(var i=0; i<ele.length; i++){  
                  if(ele[i].type=='checkbox')  
                      ele[i].checked=false;  
              }
          var ele=document.getElementsByName('select1',);  
              for(var i=0; i<ele.length; i++){  
                  if(ele[i].type=='checkbox')  
                      ele[i].checked=false;  
              }
          var ele=document.getElementsByName('checkall',);  
          for(var i=0; i<ele.length; i++){  
              if(ele[i].type=='checkbox')  
                  ele[i].checked=false;  
              }
      }
      });
  });
  function check_uncheck_checkbox(isChecked) {
      if(isChecked) {
          $('input[name="select"]').each(function() { 
              this.checked = true; 
          });
      } else {
          $('input[name="select"]').each(function() {
              this.checked = false;
          });
      }
    }
    function check_uncheck_checkbox1(isChecked) {
      if(isChecked) {
          $('input[name="select1"]').each(function() { 
              this.checked = true; 
          });
      } else {
          $('input[name="select1"]').each(function() {
              this.checked = false;
          });
      }
    }


    $('#schoffice-color').click(function(){
      toastr.info('Only For Selected Student');
    });
</script>