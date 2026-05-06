<?php
    include('../include/navigationheader1.php'); 

    $subjectid = $_GET['subjectid'];
    $facultyid = $_GET['facultyid'];
    $subjectcode = $_GET['subjectcode'];
    $subjecttitle = $_GET['subjecttitle'];
    $subjectsy = $_GET['subjectsy'];

    $subjectinfo = mysqli_query($conn,"SELECT * FROM subject WHERE id='$subjectid'");
    $teachername = mysqli_query($conn,"SELECT * FROM teacher WHERE id='$facultyid'");
    $gradesheets=mysqli_query($conn,"SELECT * FROM gradesheets");
    $rowinfo = mysqli_fetch_assoc($subjectinfo);
    $rowname = mysqli_fetch_assoc($teachername);
    $rowgsheets = mysqli_fetch_assoc($gradesheets);

     /* --------------------------------------------------------------------------------------------------------------------------------- */

    $teacherlabel=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$facultyid' AND term='Prelim' AND subid='$subjectid'");
    $rowtl=mysqli_fetch_assoc($teacherlabel);

    $pre_tltotal = $rowtl['pt1'] +  $rowtl['pt2'] + $rowtl['pt3'] + $rowtl['pt4'] + $rowtl['pt5'];
    $pre_tl_quiztotal = $rowtl['quiz1'] +  $rowtl['quiz2'] + $rowtl['quiz3'] + $rowtl['quiz4'] + $rowtl['quiz5'];

    $teacherlabel1=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$facultyid' AND term='Midterm' AND subid='$subjectid'");
    $rowtl1=mysqli_fetch_assoc($teacherlabel1);

    $mid_tltotal = $rowtl1['pt1'] +  $rowtl1['pt2'] + $rowtl1['pt3'] + $rowtl1['pt4'] + $rowtl1['pt5'];
    $mid_tl_quiztotal = $rowtl1['quiz1'] +  $rowtl1['quiz2'] + $rowtl1['quiz3'] + $rowtl1['quiz4'] + $rowtl1['quiz5'];

    $teacherlabel2=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$facultyid' AND term='Prefinal' AND subid='$subjectid'");
    $rowtl2=mysqli_fetch_assoc($teacherlabel2);

    $pref_tltotal = $rowtl2['pt1'] +  $rowtl2['pt2'] + $rowtl2['pt3'] + $rowtl2['pt4'] + $rowtl2['pt5'];
    $pref_tl_quiztotal = $rowtl2['quiz1'] +  $rowtl2['quiz2'] + $rowtl2['quiz3'] + $rowtl2['quiz4'] + $rowtl2['quiz5'];

    $teacherlabel3=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$facultyid' AND term='Final' AND subid='$subjectid'");
    $rowtl3=mysqli_fetch_assoc($teacherlabel3);

    $final_tltotal = $rowtl3['pt1'] +  $rowtl3['pt2'] + $rowtl3['pt3'] + $rowtl3['pt4'] + $rowtl3['pt5'];
    $final_tl_quiztotal = $rowtl3['quiz1'] +  $rowtl3['quiz2'] + $rowtl3['quiz3'] + $rowtl3['quiz4'] + $rowtl3['quiz5'];

    /* --------------------------------------------------------------------------------------------------------------------------------- */
    
    
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-address-book"></i> <b>Student List </b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Faculty</li>
                                <li class="breadcrumb-item active">Student List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-list-alt"></i> Student List of Faculty</h3>
                        </div>
                        <div class="card-body p-1 pt-2">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Prelim</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Midterm</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Prefinal</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Final</button>
                            </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <div class="table-responsive px-2 pt-3"> 
                                    <?php
                                    include "t_prelim.php";
                                    ?>
                                    <div class="btn-group py-2">
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="exportTableToExcel('tblData')" id="button-all"><i class="fas fa-file-export"></i> Export To Excel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <div class="table-responsive px-2 pt-3"> 
                                    <?php
                                     include "t_midterm.php";
                                    ?>
                                    <div class="btn-group py-2">
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="exportTableToExcel('tblData1')" id="button-all"><i class="fas fa-file-export"></i> Export To Excel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                <div class="table-responsive px-2 pt-3"> 
                                    <?php
                                    include "t_prefinal.php";
                                    ?>
                                    <div class="btn-group py-2">
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                        <button class="btn btn-sm btn-dark elevation-3" onclick="exportTableToExcel('tblData2')" id="button-all"><i class="fas fa-file-export"></i> Export To Excel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                <div class="table-responsive px-2 pt-3"> 
                                        <?php
                                        include "t_final.php";
                                        ?>
                                        <div class="btn-group py-2">
                                            <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                            <button class="btn btn-sm btn-dark elevation-3" onclick="exportTableToExcel('tblData3')" id="button-all"><i class="fas fa-file-export"></i> Export To Excel</button>
                                        </div>
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
<div class="modal fade" id="addsubjects" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
        <div class="modal-body" id="file_list">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
    $(document).on('click', '.add_subjects', function(){

        var id = $(this).data("id");

        $.ajax({
        url:"assign_subjects.php",
        method:"POST",
        data:{id:id},
        success:function(data)
        {
            $('#file_list').html(data);
            $('#addsubjects').modal('show');
        }
        });
    });

    $(document).on("click", ".delete_teachsub", function(){
            
        var subjectid = $(this).data("id");
        var facultyid = $(this).data("faid");
    
        var action = "delete_faculty_subject";
    
        if(confirm("Are you sure you want to remove subject?"))
            {
                $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action, facultyid:facultyid,subjectid:subjectid},
                success:function(data)
                {
                location.reload(true);
                }
                });
            }
    });

});

function exportTableToExcel(tblData, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tblData);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
 
    filename = filename?filename+'.xls': 'Student_Grades.xls';
    
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>