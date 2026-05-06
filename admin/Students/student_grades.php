<?php
    include('../include/navigationheader1.php'); 
    $studentid = $_GET['id'];
    $stdid = $_GET['stdid'];
    $name = $_GET['name'];
    $course = $_GET['course'];
    $year = $_GET['year'];
    $gender = $_GET['gender'];
    $section = $_GET['section'];
    $sem = $_GET['sem'];
    $sy = $_GET['sy'];
    $recordid = $_GET['recordid'];

?>
<div class="content-wrapper pt-4" >
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header hide">
                            <h3 class="card-title"><b> Student Grades</b></h3>
                        </div>
                        <span id="divToPrint">
                        <div class="text-center pt-3" style="font-size: 13px;" >
                            <p >
                            <img src="../../img/LogoCSAV.png" alt="Avatar" width="50px" height="50px">
                            <b><h6>Colegio de Stat.Ana de Victorias INC.</h6></b>
                            <h6>Osmeña Ave. Brgy 6, Victorias City</h6>
                            <b>OFFICE OF THE REGISTRAR</b><br/>
                            <b>STUDENTS SEMESTRAL GRADING REPORT SHEET</b><br/>
                            <b>FINAL GRADES</b><br/>
                            <b> <?php echo $sem;?> SEMESTER, <?php echo $sy;?></b>
                            </p>
                        </div>
                        <div class="table-responsive px-2 pt-3" >
                            <table id="data_table" class="table table-striped table-bordered table-sm" style="border: 1px solid black;">
                                <thead >
                                    <th>Student No.</th>
                                    <th>Full Name</th>
                                    <th>Sex</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Section</th>
                                </thead>
                                <tbody>
                                    <td><?php echo $stdid;?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $course; ?></td>
                                    <td><?php echo $year; ?></td>
                                    <td><?php echo $section; ?></td>
                                </tbody>
                                <table class="table table-sm table-striped table-bordered" style="border: none;">
                                    <thead>
                                        <th>Subjects</th>
                                        <th>Grades</th>
                                        <th>Units</th>
                                        <th>Remarks</th>
                                    </thead>
                                    <?php
                                        $total=0;
                                        $totaunits = 0;
                                     $studentQ = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$studentid' AND sem='$sem' AND sy='$sy'");
                                            while($row = mysqli_fetch_assoc($studentQ)){
                                                $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row['subid']."'");
                                                while ($rowsub = mysqli_fetch_assoc($subject)){

                                                $prelim = mysqli_query($conn, "SELECT * FROM student_prelim WHERE studid = '$studentid' AND subid='".$rowsub['id']."'");
                                                $row3 = mysqli_fetch_assoc($prelim);
                                                $midterm = mysqli_query($conn, "SELECT * FROM student_midterm WHERE studid = '$studentid' AND subid='".$rowsub['id']."'");
                                                $row4 = mysqli_fetch_assoc($midterm);
                                                $prefinal = mysqli_query($conn, "SELECT * FROM student_prefinal WHERE studid = '$studentid' AND subid='".$rowsub['id']."'");
                                                $row5 = mysqli_fetch_assoc($prefinal);
                                                $final = mysqli_query($conn, "SELECT * FROM student_final WHERE studid = '$studentid' AND subid='".$rowsub['id']."'");
                                                $row6 = mysqli_fetch_assoc($final);
                                               
                                            ?>
                                    <tbody style="border: none;">
                                        <tr>
                                            <td style="border: none;"><?php echo $rowsub['code'];?></td>
                                            <td style="border: none;">
                                            <?php
                                            $average = $row3['average'] + $row4['average'] + $row5['average'] + $row6['average'];
                                            $average = $average /4;
                                            $average = round($average);
                                           
                                            include "gradesheet.php";
                                            
                                            ?>
                                            </td>
                                            <td style="border: none;"><?php echo $rowsub['unit'];?></td>
                                            <td style="border: none;"><?php if ($average > 74.5){ echo  'Passed'; }else if($average == 0){  echo  'None'; }else if($average < 74.5){echo 'Failed';} ?></td>
                                        </tr>

                                        <?php
                                            $totalsub = mysqli_num_rows($studentQ);
                                            $total += $average;
                                            $average = $total;
                                            $totaunits += $rowsub['unit'];
                                            }
                                        }
                                        if($total == ''){
                                            $total = 0;
                                        }else{
                                            $total /= $totalsub;
                                        }
                                        
                                        ?>
                                    <tr>
                                        <td style="border: none;"></td>
                                        <td style="border: none;"></td>
                                        <td ><?php echo $totaunits; ?></td>
                                        <td style="border: none;"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </table>
                            <div class="row">
                                <div class="col-md-3 pt-5">
                                    <p style="border: 1px solid black; width: 300px; padding-left: 10px;">
                                        GENERAL AVERAGE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php  
                                        $average = round($total);
                                        echo $average; echo " "; echo "("; include "gradesheet.php"; echo ")"; 
                                        ?>
                                </div>
                                <div class="col-md-3 pt-5">
                                </div>
                                <div class="col-md-2 pt-5">
                                </div>
                                <div class="col-md-3 pt-5 float-right">
                                    <p style="border-bottom: 1px solid black;; width: 300px; padding-left: 10px;">
                                        OIC Registrar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </p>
                                </div>
                            </div>
                            </span>
                            <div class="btn-group py-2">
                                <button class="btn btn-sm btn-dark hide elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                <button type="button" class="btn btn-dark btn-sm hide elevation-3" onclick="printPage()" value="Print" id="button-all"><i class="fas fa-print"></i> Print</button>
                                <button type="button" class="release btn btn-dark btn-sm hide elevation-3" data-average="<?php echo $average;?>" data-recordid="<?php echo $recordid; ?>"value="Print" id="button-all"><i class="fas fa-paper-plane"></i> Release to Student</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>
<script>

    function totalaverage(){
    }
    function printPage() {
        window.print();
    }

    $(document).on('click', '.release', function(){

        var recordid = $(this).data("recordid");
        var average = $(this).data("average");
      
        var action="release_student";
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Release it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action,average:average,recordid:recordid},
            success:function(data)
            {
                if(data =="success"){
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Student Final Grades Release Successful!',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });
                }else if(data == "warning"){
                    Swal.fire({
                    position: 'center',
                    icon: data,
                    title: 'Invalid to Release Final Grades to Student!',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });
                }
            }
            });
        }
        })
    });
</script>
<style>
    @media print {
     .hide{  
      display:none;
      visibility: none;
        }
    }
    @page {
           margin-top: 0;
           margin-bottom: 0;
          
         }
         table {
    border: 1px solid #CCC;
    border-collapse: collapse;
}
</style>