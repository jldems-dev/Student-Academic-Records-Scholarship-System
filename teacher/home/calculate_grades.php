<?php
    include "include/navigationheader.php";
    include "query_grades.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-calculator"></i> <b>Compute Grades of Students</b>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">My Student / Compute Grades</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-id-card"></i> Student Grades</h3>
                        </div>
                        <div class="left-section pt-3 pl-2">
                            <p>
                            <h3><i class="fas fa-book-open"></i> Subject Name</h3>
                            <b>Subject Code :</b> <?php echo $rowsub['code'];?><br/>
                            <b>Subject Title :</b> <?php echo $rowsub['title']; ?><br/>
                            <b>Units :</b> <?php echo $rowsub['unit']; ?><br/>
                            </p>
                        </div>
                        <hr>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>Full Name</th>
                                    <th>Course</th>
                                    <th>Year & Section</th>
                                    <th>Prelim</th>
                                    <th>Midterm</th>
                                    <th>Prefinal</th>
                                    <th>Final</th>
                                    <th>Average</th>
                                    <th>Remarks</th>
                                </thead>
                                <tbody>
                                    <?php

                                        $average =  $row['average']+
                                                    $row1['average']+
                                                    $row2['average']+
                                                    $row3['average'];
                                                    $average = $average/4;
                                                    $average = round($average);
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?php echo $rowstudent['lname'];?>, <?php echo $rowstudent['fname'];?> <?php echo $rowstudent['mname'];?>.</td>
                                        <td style="vertical-align: middle;"><?php echo $rowstudent['course'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $rowstudent['year'];?>-<?php echo $rowstudent['section'];?></td>
                                        <td style="background: yellow;"><?php echo $row['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row1['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row2['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row3['average'];?></td>
                                        <td style="background: <?= ($average > 74 ? 'green' : 'red'); ?>"><?php echo $average;?></td>
                                        <td style="background: <?= ($average > 74 ? 'green' : 'red'); ?>" ><?php if ($average > 74){ echo  'Pass'; }else if($average == 0){  echo  'None'; }else if($average < 74){echo 'Failed';} ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-14 pt-5">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="tab" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Prelim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="tab" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Midterm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="tab" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Prefinal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="tab" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Final</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="custom-tabs-one-tabContent" style="font-size: 14px;">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="col-lg-12 pt-5 p-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Performance Task <?php echo $rowgsheets['class_standing'];?>%</p>
                                                        <hr>
                                                        <table id="ftable" class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                <th colspan="7">
                                                                    <div class="text-left">
                                                                    Performance Task <?php echo $rowgsheets['class_standing'];?>% 
                                                                    <button class="addcolumnpt btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Prelim" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                ?>
                                                                <col style="visibility:<?php if($rowttoggle['pt'.$i] == ''){ echo "collapse"; }else{ echo $rowttoggle['pt'.$i];}?>"/>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl1" data-name="Prelim"><?php echo $rowtl['pt1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl2" data-name="Prelim"><?php echo $rowtl['pt2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl3" data-name="Prelim"><?php echo $rowtl['pt3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl4" data-name="Prelim"><?php echo $rowtl['pt4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="t15" data-name="Prelim"><?php echo $rowtl['pt5']; ?></td>
                                                                <td><?php echo $pre_tltotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="1" data-name="Prelim"><?php echo $row['pt1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="2" data-name="Prelim"><?php echo $row['pt2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="3" data-name="Prelim"><?php echo $row['pt3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="4" data-name="Prelim"><?php echo $row['pt4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="5" data-name="Prelim"><?php echo $row['pt5']; ?></td>
                                                                <td><?php echo $pre_pttotal;?></td>
                                                                <td id="g_green"><?php echo round($pre_ptequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Quizzes <?php echo $rowgsheets['quizzes'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="7">
                                                                    <div class="text-left">
                                                                        Quizzes <?php echo $rowgsheets['quizzes'];?>%
                                                                        <button class="addcolumnquiz btn btn-sm btn-primary float-right"  data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Prelim" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                        echo '<col style="visibility: '.$rowttoggle['quiz'.$i].'"/>';
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl6" data-name="Prelim"><?php echo $rowtl['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl7" data-name="Prelim"><?php echo $rowtl['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl8" data-name="Prelim"><?php echo $rowtl['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl9" data-name="Prelim"><?php echo $rowtl['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl10" data-name="Prelim"><?php echo $rowtl['quiz5']; ?></td>
                                                                <td><?php echo $pre_tl_quiztotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="6" data-name="Prelim"><?php echo $row['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="7" data-name="Prelim"><?php echo $row['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="8" data-name="Prelim"><?php echo $row['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="9" data-name="Prelim"><?php echo $row['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="10" data-name="Prelim"><?php echo $row['quiz5']; ?></td>
                                                                <td><?php echo $pre_quiztotal;?></td>
                                                                <td id="g_green"><?php echo round($pre_quizequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>P.E <?php echo $rowgsheets['practical_exam'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3">Written Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>1</th>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl['id'];?>" name="tl11" data-name="Prelim"><?php echo $rowtl['exam']; ?></td>
                                                                <td><?php echo $rowtl['exam']; ?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="11" data-name="Prelim"><?php echo $row['exam1']; ?></td>
                                                                <td><?php echo $pre_examtotal; ?></td>
                                                                <td id="g_green"><?php echo round($pre_examequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-0">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Computation</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th>P.T</th>
                                                                    <th>Q</th>
                                                                    <th>W.E</th>
                                                                    <th>Prelim</th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo $rowgsheets['class_standing'];?>%</th>
                                                                    <th><?php echo $rowgsheets['quizzes'];?>%</th>
                                                                    <th><?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                    <th id="g_green">Total</th>
                                                                </tr>
                                                                <tr style="background-color: yellow;">
                                                                    <th><?php echo round($pre_tltotal);?></th>
                                                                    <th><?php echo round($pre_tl_quiztotal);?></th>
                                                                    <th><?php echo $rowtl['exam'];?></th>
                                                                    <th id="g_green"><?php echo round($prelimtotal);?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo round($pre_ptequi);?></th>
                                                                    <th><?php echo round($pre_quizequi);?></th>
                                                                    <th><?php echo round($pre_examequi);?></th>
                                                                    <th id="g_green"><?php echo round($prelimtotal);?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit" class="save_prelim btn btn-dark btn-sm" id="button-all"
                                            data-id="<?php echo $studid; ?>" 
                                            data-subid="<?php echo $subid;?>"
                                            data-prelim="<?php echo $prelimtotal;?>"><i class="fas fa-file-import"></i> Submit Prelim Grade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  Midterm -->
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="col-lg-12 pt-5 p-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Performance Task <?php echo $rowgsheets['class_standing'];?>%</p>
                                                        <hr>
                                                        <table id="ftable" class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                <th colspan="7">
                                                                    <div class="text-left">
                                                                    Performance Task <?php echo $rowgsheets['class_standing'];?>% 
                                                                    <button class="addcolumnpt btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Midterm" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                        echo '<col style="visibility: '.$rowttoggle1['pt'.$i].'"/>';
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl1" data-name="Midterm"><?php echo $rowtl1['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl2" data-name="Midterm"><?php echo $rowtl1['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl3" data-name="Midterm"><?php echo $rowtl1['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl4" data-name="Midterm"><?php echo $rowtl1['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl5" data-name="Midterm"><?php echo $rowtl1['pt5'];?></td>
                                                                <td><?php echo $mid_tltotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="1" data-name="Midterm"><?php echo $row1['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="2" data-name="Midterm"><?php echo $row1['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="3" data-name="Midterm"><?php echo $row1['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="4" data-name="Midterm"><?php echo $row1['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="5" data-name="Midterm"><?php echo $row1['pt5'];?></td>
                                                                <td><?php echo $mid_pttotal;?></td>
                                                                <td id="g_green"><?php echo round($mid_ptequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Quizzes <?php echo $rowgsheets['quizzes'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="7">
                                                                    <div class="text-left">
                                                                        Quizzes <?php echo $rowgsheets['quizzes'];?>%
                                                                        <button class="addcolumnquiz btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Midterm" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                        echo '<col style="visibility: '.$rowttoggle1['quiz'.$i].'"/>';
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl6" data-name="Midterm"><?php echo $rowtl1['quiz1']; ?></td>
                                                                <td contenteditablle="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl7" data-name="Midterm"><?php echo $rowtl1['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl8" data-name="Midterm"><?php echo $rowtl1['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl9" data-name="Midterm"><?php echo $rowtl1['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl10" data-name="Midterm"><?php echo $rowtl1['quiz5']; ?></td>
                                                                <td><?php echo $mid_tl_quiztotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="6" data-name="Midterm"><?php echo $row1['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="7" data-name="Midterm"><?php echo $row1['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="8" data-name="Midterm"><?php echo $row1['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="9" data-name="Midterm"><?php echo $row1['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="10" data-name="Midterm"><?php echo $row1['quiz5']; ?></td>
                                                                <td><?php echo $mid_quiztotal;?></td>
                                                                <td id="g_green"><?php echo round($mid_quizequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>P.E <?php echo $rowgsheets['practical_exam'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3">Written Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>1</th>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl1['id'];?>" name="tl11" data-name="Midterm"><?php echo $rowtl1['exam']; ?></td>
                                                                <td><?php echo $rowtl1['exam']; ?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="11" data-name="Midterm"><?php echo $row1['exam1']; ?></td>
                                                                <td><?php echo $mid_examtotal; ?></td>
                                                                <td id="g_green"><?php echo round($mid_examequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-0">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Computation</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th>P.T</th>
                                                                    <th>Q</th>
                                                                    <th>W.E</th>
                                                                    <th>Midterm</th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo $rowgsheets['class_standing'];?>%</th>
                                                                    <th><?php echo $rowgsheets['quizzes'];?>%</th>
                                                                    <th><?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                    <th id="g_green">Total</th>
                                                                </tr>
                                                                <tr style="background-color: yellow;">
                                                                    <th><?php echo round($mid_tltotal); ?></th>
                                                                    <th><?php echo round($mid_tl_quiztotal);?></th>
                                                                    <th><?php echo $rowtl1['exam'];?></th>
                                                                    <th id="g_green"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo round($mid_ptequi); ?></th>
                                                                    <th><?php echo round($mid_quizequi);?></th>
                                                                    <th><?php echo round($mid_examequi);?></th>
                                                                    <th id="g_green"><?php echo round($midtermtotal);?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit" class="save_midterm btn btn-dark btn-sm" id="button-all"
                                            data-id="<?php echo $studid; ?>" 
                                            data-subid="<?php echo $subid;?>"
                                            data-midterm="<?php echo $midtermtotal;?>"><i class="fas fa-file-import"></i> Submit Midterm Grade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Prefinal -->
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <div class="col-lg-14 pt-5 p-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Performance Task <?php echo $rowgsheets['class_standing'];?>%</p>
                                                        <hr>
                                                        <table id="ftable" class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                <th colspan="7">
                                                                    <div class="text-left">
                                                                    Performance Task <?php echo $rowgsheets['class_standing'];?>% 
                                                                    <button class="addcolumnpt btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Prefinal" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                        echo '<col style="visibility: '.$rowttoggle2['pt'.$i].'"/>';
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl1" data-name="Prefinal"><?php echo $rowtl2['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl2" data-name="Prefinal"><?php echo $rowtl2['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl3" data-name="Prefinal"><?php echo $rowtl2['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl4" data-name="Prefinal"><?php echo $rowtl2['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl5" data-name="Prefinal"><?php echo $rowtl2['pt5'];?></td>
                                                                <td><?php echo $pref_tltotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="1" data-name="Prefinal"><?php echo $row2['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="2" data-name="Prefinal"><?php echo $row2['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="3" data-name="Prefinal"><?php echo $row2['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="4" data-name="Prefinal"><?php echo $row2['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="5" data-name="Prefinal"><?php echo $row2['pt5'];?></td>
                                                                <td><?php echo $pref_pttotal;?></td>
                                                                <td id="g_green"><?php echo round($pref_ptequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Quizzes <?php echo $rowgsheets['quizzes'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="7">
                                                                    <div class="text-left">
                                                                        Quizzes <?php echo $rowgsheets['quizzes'];?>%
                                                                        <button class="addcolumnquiz btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Prefinal" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <col style="visibility:<?php echo $rowttoggle2['quiz1']?>"/>
                                                                <col style="visibility:<?php echo $rowttoggle2['quiz2']?>"/>
                                                                <col style="visibility:<?php echo $rowttoggle2['quiz3']?>"/>
                                                                <col style="visibility:<?php echo $rowttoggle2['quiz4']?>"/>
                                                                <col style="visibility:<?php echo $rowttoggle2['quiz5']?>"/>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl6" data-name="Prefinal"><?php echo $rowtl2['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl7" data-name="Prefinal"><?php echo $rowtl2['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl8" data-name="Prefinal"><?php echo $rowtl2['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl9" data-name="Prefinal"><?php echo $rowtl2['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl10" data-name="Prefinal"><?php echo $rowtl2['quiz5']; ?></td>
                                                                <td><?php echo $pref_tl_quiztotal;?></td>
                                                                <td id="g_green"><?php echo round($pref_quizequi);?></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="6" data-name="Prefinal"><?php echo $row2['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="7" data-name="Prefinal"><?php echo $row2['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="8" data-name="Prefinal"><?php echo $row2['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="9" data-name="Prefinal"><?php echo $row2['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="10" data-name="Prefinal"><?php echo $row2['quiz5']; ?></td>
                                                                <td><?php echo $pref_quiztotal;?></td>
                                                                <td id="g_green"><?php echo round($pref_quizequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>P.E <?php echo $rowgsheets['practical_exam'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3">Written Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>1</th>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl2['id'];?>" name="tl11" data-name="Prefinal"><?php echo $rowtl2['exam']; ?></td>
                                                                <td><?php echo $rowtl2['exam']; ?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="11" data-name="Prefinal"><?php echo $row2['exam1']; ?></td>
                                                                <td><?php echo $pref_examtotal; ?></td>
                                                                <td id="g_green"><?php echo round($pref_examequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-0">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Computation</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th>P.T</th>
                                                                    <th>Q</th>
                                                                    <th>W.E</th>
                                                                    <th>Prefinal</th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo $rowgsheets['class_standing'];?>%</th>
                                                                    <th><?php echo $rowgsheets['quizzes'];?>%</th>
                                                                    <th><?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                    <th id="g_green">Total</th>
                                                                </tr>
                                                                <tr style="background-color: yellow;">
                                                                    <th><?php echo round($pref_tltotal);?></th>
                                                                    <th><?php echo round($pref_tl_quiztotal);?></th>
                                                                    <th><?php echo $rowtl2['exam'];?></th>
                                                                    <th id="g_green"> </th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo round($pref_ptequi);?></th>
                                                                    <th><?php echo round($pref_quizequi);?></th>
                                                                    <th><?php echo round($pref_examequi);?></th>
                                                                    <th id="g_green"><?php echo round($prefinaltotal);?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit" class="save_prefinal btn btn-dark btn-sm" id="button-all"
                                            data-id="<?php echo $studid; ?>" 
                                            data-subid="<?php echo $subid;?>"
                                            data-prefinal="<?php echo $prefinaltotal;?>"><i class="fas fa-file-import"></i> Submit Prefinal Grade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Final -->
                            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                <div class="col-lg-12 pt-5 p-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Performance Task <?php echo $rowgsheets['class_standing'];?>%</p>
                                                        <hr>
                                                        <table id="ftable" class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                <th colspan="7">
                                                                    <div class="text-left">
                                                                    Performance Task <?php echo $rowgsheets['class_standing'];?>% 
                                                                    <button class="addcolumnpt btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Final" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                    for($i = 1; $i <=5; $i++){
                                                                        echo '<col style="visibility: '.$rowttoggle3['pt'.$i].'"/>';
                                                                    }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl1" data-name="Final"><?php echo $rowtl3['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl2" data-name="Final"><?php echo $rowtl3['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl3" data-name="Final"><?php echo $rowtl3['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl4" data-name="Final"><?php echo $rowtl3['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl5" data-name="Final"><?php echo $rowtl3['pt5'];?></td>
                                                                <td><?php echo $final_tltotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="1" data-name="Final"><?php echo $row3['pt1'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="2" data-name="Final"><?php echo $row3['pt2'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="3" data-name="Final"><?php echo $row3['pt3'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="4" data-name="Final"><?php echo $row3['pt4'];?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="5" data-name="Final"><?php echo $row3['pt5'];?></td>
                                                                <td><?php echo $final_pttotal;?></td>
                                                                <td id="g_green"><?php echo round($final_ptequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Quizzes <?php echo $rowgsheets['quizzes'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="7">
                                                                    <div class="text-left">
                                                                        Quizzes <?php echo $rowgsheets['quizzes'];?>%
                                                                        <button class="addcolumnquiz btn btn-sm btn-primary float-right" data-id="<?php echo $newid;?>" data-subid=<?php echo $rowsub['id'];?> data-name="Final" data-tog="collapse"><i class="fas fa-plus"></i></button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    for($i=1; $i<=5; $i++){
                                                                        echo '<th>'.$i.'</th>';
                                                                    }
                                                                    ?>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                <?php
                                                                for($i = 1; $i <=5; $i++){
                                                                ?>
                                                                <col style="visibility:<?php echo $rowttoggle3['quiz'.$i]?>"/>
                                                                <?php
                                                                }
                                                                ?>
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl6" data-name="Final"><?php echo $rowtl3['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl7" data-name="Final"><?php echo $rowtl3['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl8" data-name="Final"><?php echo $rowtl3['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl9" data-name="Final"><?php echo $rowtl3['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl10" data-name="Final"><?php echo $rowtl3['quiz5']; ?></td>
                                                                <td><?php echo $final_tl_quiztotal;?></td>
                                                                <td id="g_green"></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="6" data-name="Final"><?php echo $row3['quiz1']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="7" data-name="Final"><?php echo $row3['quiz2']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="8" data-name="Final"><?php echo $row3['quiz3']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="9" data-name="Final"><?php echo $row3['quiz4']; ?></td>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="10" data-name="Final"><?php echo $row3['quiz5']; ?></td>
                                                                <td><?php echo $final_quiztotal;?></td>
                                                                <td id="g_green"><?php echo round($final_quizequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>P.E <?php echo $rowgsheets['practical_exam'];?>%</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3">Written Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>1</th>
                                                                    <th>Total</th>
                                                                    <th id="g_green">Equi</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody style="background-color: yellow;">
                                                                <td contenteditable="true" class="update" data-id="<?php echo $rowtl3['id'];?>" name="tl11" data-name="Final"><?php echo $rowtl3['exam']; ?></td>
                                                                <td><?php echo $rowtl3['exam']; ?></td>
                                                                <td id="g_green"><?php echo round($final_examequi);?></td>
                                                            </tbody>
                                                            <tbody>
                                                                <td contenteditable="true" class="update" data-id="<?php echo $row['id'];?>" name="11" data-name="Final"><?php echo $row3['exam1']; ?></td>
                                                                <td><?php echo $final_examtotal; ?></td>
                                                                <td id="g_green"><?php echo round($final_examequi);?></td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-0">
                                                <div class="table-responsive">
                                                    <div class="inner text-center">
                                                        <p>Computation</p>
                                                        <hr>
                                                        <table class="table table-bordered table-sm" >
                                                            <thead>
                                                                <tr>
                                                                    <th>P.T</th>
                                                                    <th>Q</th>
                                                                    <th>W.E</th>
                                                                    <th>Final</th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo $rowgsheets['class_standing'];?>%</th>
                                                                    <th><?php echo $rowgsheets['quizzes'];?>%</th>
                                                                    <th><?php echo $rowgsheets['practical_exam'];?>%</th>
                                                                    <th id="g_green">Total</th>
                                                                </tr>
                                                                <tr style="background-color: yellow;">
                                                                    <th><?php echo round($final_tltotal);?></th>
                                                                    <th><?php echo round($final_tl_quiztotal);?></th>
                                                                    <th><?php echo $rowtl3['exam'];?></th>
                                                                    <th id="g_green"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th><?php echo round($final_ptequi);?></th>
                                                                    <th><?php echo round($final_quizequi);?></th>
                                                                    <th><?php echo round($final_examequi);?></th>
                                                                    <th id="g_green"><?php echo round($finaltotal);?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit" class="save_final btn btn-dark btn-sm" id="button-all"
                                            data-id="<?php echo $studid; ?>" 
                                            data-subid="<?php echo $subid;?>"
                                            data-final="<?php echo $finaltotal;?>"><i class="fas fa-file-import"></i> Submit Final Grade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function(){

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
        console.log(activeTab);

    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

    $(document).on('blur', '.update', function(){

        var id = $(this).data("id");
        var term = $(this).data("name");
        var subid = $(this).data("subid");
        var name = $(this).attr("name");
        var value = $(this).text();

        var action = "computation";

        $.ajax({
        url:"my_student_action.php",
        method:"POST",
        data:{name:name,value:value,id:id,term:term,action:action,subid:subid},
        success:function(data)
        {
         toastr.success(data);
        }
        });
    });

    $(document).on("click", ".addcolumnpt", function(){
            
            var id = $(this).data("id");
            var term = $(this).data("name");
            var subid = $(this).data("subid");
            var toggle = $(this).data("tog");
        
            var action = "add_column_pt";

            $.ajax({
            url:"actiontoggle.php",
            method:"POST",
            data:{action:action,id:id,term:term,subid:subid,toggle:toggle},
            success:function(data)
            {
               location.reload(true);
            }
            });
        });

        $(document).on("click", ".addcolumnquiz", function(){
            
            var id = $(this).data("id");
            var term = $(this).data("name");
            var subid = $(this).data("subid");
            var toggle = $(this).data("tog");
        
            var action = "add_column_quiz";

            $.ajax({
            url:"actiontoggle.php",
            method:"POST",
            data:{action:action,id:id,term:term,subid:subid,toggle:toggle},
            success:function(data)
            {
                location.reload(true);
            }
            });
        });

    $(document).on("click", ".save_prelim", function(){
            
        var subid = $(this).data("subid");
        var studid = $(this).data("id");
        var prelim = $(this).data("prelim");
    
        var action = "prelim";

        Swal.fire({
        title: 'Are you sure you want to Submit Prelim Grades?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Submit it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url:"my_student_action.php",
            method:"POST",
            data:{action:action, subid:subid,studid:studid,prelim:prelim},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Prelim Grade Submit Successful!',
                showConfirmButton: false,
                timer: 1500
                }).then((result) => {
                location.reload();
                });
            }
            });
            }
        })
    });
    $(document).on("click", ".save_midterm", function(){
            
            var subid = $(this).data("subid");
            var studid = $(this).data("id");
            var midterm = $(this).data("midterm");
        
            var action = "midterm";
        
        Swal.fire({
        title: 'Are you sure you want to Submit Midterm Grades?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Submit it!'
        }).then((result) => {
        if (result.isConfirmed) {
                $.ajax({
                url:"my_student_action.php",
                method:"POST",
                data:{action:action, subid:subid,studid:studid,midterm:midterm},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Midterm Grade Submit Successful!',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
                    location.reload();
                    });
                   
                }
                });
                }
            })
        });
        $(document).on("click", ".save_prefinal", function(){
            
            var subid = $(this).data("subid");
            var studid = $(this).data("id");
            var prefinal = $(this).data("prefinal");
        
            var action = "prefinal";
        
            Swal.fire({
            title: 'Are you sure you want to Submit Prefinal Grades?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url:"my_student_action.php",
                method:"POST",
                data:{action:action, subid:subid,studid:studid,prefinal:prefinal},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Prefinal Grade Submit Successful!',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
                    location.reload();
                    });
                }
                });
                }
            })
        });
        $(document).on("click", ".save_final", function(){
            
            var subid = $(this).data("subid");
            var studid = $(this).data("id");
            var final = $(this).data("final");
        
            var action = "final";
        
            Swal.fire({
            title: 'Are you sure you want to Submit Final Grades?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url:"my_student_action.php",
                method:"POST",
                data:{action:action, subid:subid,studid:studid,final:final},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Final Grade Submit Successful!',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
                    location.reload();
                    });
                }
                });
                }
            })
        });
});
</script>