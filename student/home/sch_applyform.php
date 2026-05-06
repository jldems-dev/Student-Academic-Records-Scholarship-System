<?php
    include "include/navigationheader.php";

    $schid=$_GET['schid'];
    $schname=$_GET['schname'];
    $schsy=$_GET['schsy'];
 ?>
 <style> 
.form-control {
  height: 50%;
  outline: 0;
  border-width: 0 0 2px;
  text-transform: uppercase;
}
.form-label{
    font-size: 12px;
}
::placeholder {
  font-size: 14px;
}
optgroup { 
    font-size:12px; 
    }
.text-danger{
    font-size:14px;
}
</style>
 <div class="content-wrapper" style="padding-top: 70px">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
			    <div class ="card" id="index-color">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                        <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
                        <h3 class="card-title w-100"><?php echo $schname;?></h3>
                        </div>
                    </div>
			    </div>
                <div class="card">
                    <div class="card-header p-2" id="card-header1">
                        <b><h5 class="card-title text-left"><?php echo strtoupper($schname);?> APPLICATION FORM FOR AY <?php echo $schsy;?></b></h5>
                    </div>
                    <div class="card-body p-1 ">
                        <p class="text-left">Please Fill in the needed Information</p>
                    </div>
                </div>
                <form method="post" id="upload_form" action="" enctype='multipart/form-data' class="row">
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3" has-error>
                                <label class="form-label" class="error">STUDENT ID *</label>
                                <input type="text" class="form-control" name="studid" id="studid"  value="<?php echo $row['studid'];?>"  maxlenght="9" required > 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">LAST NAME *</label>
                                <input type="text" class="form-control" name="lname" id="lname"  value="<?php echo $row['lname']?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">GIVEN NAME *</label>
                                <input type="text" class="form-control" name="gname" id="gname"  value="<?php echo $row['fname']?>"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">EXTENSION NAME *</label>
                                <input type="text" class="form-control" name="xname" id="xname"  placeholder="Input Here">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">MIDDLE NAME *</label>
                                <input type="text" class="form-control" name="mname" id="mname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">SEX (Male or Female) *</label>
                                <select class="form-control" name="sex" id="sex" required>
                                    <optgroup>
                                        <option value="">Select Sex</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">BIRTHDATE *</label>
                                <input type="date" class="form-control" name="bday" id="bday"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">COURSE*</label>
                                <select class="form-control" name="course" id="course">
                                    <optgroup>
                                        <option value="">Select Course</option>
                                        <?php
                                        $course=mysqli_query($conn,"SELECT * FROM course");
                                        while($rowcourse=mysqli_fetch_assoc($course)){
                                        ?>
                                        
                                            <option value="<?php echo $rowcourse['full_course_name'];?>"><?php echo $rowcourse['full_course_name'];?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">YEAR LEVEL *</label>
                                <select class="form-control" name="year" id="year" required>
                                    <optgroup>
                                        <option value="">Select Year</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">PARENTS INFORMATION</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">FATHERS NAME</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">LAST NAME *</label>
                                <input type="text" class="form-control" name="flname" id="flname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">GIVEN NAME *</label>
                                <input type="text" class="form-control" name="fgname" id="fgname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">MIDDLE NAME *</label>
                                <input type="text" class="form-control" name="fmname" id="fmname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">MOTHERS NAME</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">LAST NAME *</label>
                                <input type="text" class="form-control" name="mlname" id="mlname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">GIVEN NAME *</label>
                                <input type="text" class="form-control" name="mgname" id="mgname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">MIDDLE NAME *</label>
                                <input type="text" class="form-control" name="mmname" id="mmname"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">DSWD HOUSEHOLD NO. (Leave blank if NOT Applicable)</label>
                                <input type="text" class="form-control" name="dswd" id="dswd"  placeholder="Input Here" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">HOUSEHOLD PER CAPITA INCOME (Leave blank if NOT AppLicable)</label>
                                <input type="text" class="form-control" name="hshld" id="hshld"  placeholder="Input Here" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">PERMANENT ADDRESS</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">STREET & BARANGAY *</label>
                                <input type="text" class="form-control" name="brgy" id="brgy"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">ZIPCODE *</label>
                                <input type="text" class="form-control" name="zpcode" id="zpcode"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">TOTAL ASSESMENT FOR <?php echo $schsy;?> *</label>
                                <input type="text" class="form-control" name="ttafsem" id="ttafsem"  placeholder="First Semester">
                                <input type="text" class="form-control mt-1" name="ttassem" id="ttassem"  placeholder="Second Semester">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">DISABILITY (leave blank if NOT Applicable)</label>
                                <input type="text" class="form-control" name="dsblty" id="dsblty"  placeholder="Input Here" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">CONTACT NUMBER</label>
                                <input type="number" class="form-control" name="cn" id="cn"  placeholder="Input Here"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-default px-2">
                            <div class="form-group pt-3">
                                <label class="form-label">EMAIL ADDRESS (Please Provide the official CSAV email Account)</label>
                                <input type="email" class="form-control" name="ed" id="ed"  value="<?php echo $row['email'];?>"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" id="submit" name="submit" class="apply btn btn-sm btn-dark mb-2 elevation-3" data-id="<?php echo $row['id'];?>" data-name=<?php echo $schid;?> data-sy="<?php echo $schsy;?> " data-schname="<?php echo $schname;?>" style="background-color: #00695C;"><i class="fas fa-paper-plane"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </section>
</div>

<?php

?>
<script>

     $(document).on('click', '#submit', function(e){

        e.preventDefault();

        var id = $(this).data("id");
        var schname = $(this).data("schname");
        var schnameid = $(this).data("name");
        var schsy = $(this).data("sy");
        var studid = $('#studid').val();
        var lname = $('#lname').val();
        var gname = $('#gname').val();
        var xname = $('#xname').val();
        var mname = $('#mname').val();
        var sex = $('#sex').val();
        var bday = $('#bday').val();
        var course = $('#course').val();
        var year = $('#year').val();

        var flname = $('#flname').val();
        var fgname = $('#fgname').val();
        var fmname = $('#fmname').val();

        var mlname = $('#mlname').val();
        var mgname = $('#mgname').val();
        var mmname = $('#mmname').val();
        
        var dswd = $('#dswd').val();
        var hshld = $('#hshld').val();
        var brgy = $('#brgy').val();
        var zpcode = $('#zpcode').val();
        var ttafsem = $('#ttafsem').val();
        var ttassem = $('#ttassem').val();
        var dsblty = $('#dsblty').val();
        var cn = $('#cn').val();
        var ed = $('#ed').val();

    
        var action = "submit_appform";

        if(lname == '' || gname == '' ||
            mname==''||sex==''||
            bday==''||course==''||
            year==''||flname==''||
            fgname==''||fmname==''||
            mlname==''||mgname==''||
            mmname==''||brgy==''||
            zpcode==''||cn==''||ed==''){
            toastr.warning("Please Fill Out The Field Completely");
        }else{
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,id:id,schnameid:schnameid,
        studid:studid,lname:lname,
        gname:gname,xname:xname,
        mname:mname,sex:sex,
        bday:bday,course:course,
        year:year,flname:flname,
        fgname:fgname,fmname:fmname,
        mlname:mlname,mgname:mgname ,
        mmname:mmname,dswd:dswd,
        hshld:hshld,brgy:brgy,
        zpcode:zpcode,ttafsem:ttafsem,
        ttassem:ttassem,dsblty:dsblty,cn:cn,
        ed:ed,schsy:schsy,schname:schname},
        success:function(data)
        {
            if(data == 'warning'){
                toastr.warning("Submit Only One Per Scholarship");
            }if(data == 'error'){
                toastr.error("Error");
            }if(data == 'success'){
                toastr.success("Submit Successful");
            }
        }
        });
        }
    });
</script>
