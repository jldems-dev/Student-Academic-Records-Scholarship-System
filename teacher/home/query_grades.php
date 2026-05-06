<?php

    $studid = $_GET['studid'];
    $subid = $_GET['subid'];

    $gradesheets=mysqli_query($conn,"SELECT * FROM gradesheets");
    $rowgsheets=mysqli_fetch_assoc($gradesheets);

    $query = mysqli_query($conn, "SELECT * FROM class WHERE id='$subid'");
    $queryrow = mysqli_fetch_assoc($query);

    $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='$subid'");
    $rowsub=mysqli_fetch_assoc($subject);

    $studentinfo = mysqli_query($conn,"SELECT * FROM student WHERE id='$studid'");
    $rowstudent = mysqli_fetch_assoc($studentinfo);

    $teachertoggle=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='$newid' AND term='Prelim' AND subid='$subid'");
    $rowttoggle=mysqli_fetch_assoc($teachertoggle);

    $teachertoggle1=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='$newid' AND term='Midterm' AND subid='$subid'");
    $rowttoggle1=mysqli_fetch_assoc($teachertoggle1);

    $teachertoggle2=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='$newid' AND term='Prefinal' AND subid='$subid'");
    $rowttoggle2=mysqli_fetch_assoc($teachertoggle2);

    $teachertoggle3=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='$newid' AND term='Final' AND subid='$subid'");
    $rowttoggle3=mysqli_fetch_assoc($teachertoggle3);

    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $teacherlabel=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$newid' AND term='Prelim' AND subid='$subid'");
    $rowtl=mysqli_fetch_assoc($teacherlabel);

    $pre_tltotal = $rowtl['pt1'] +  $rowtl['pt2'] + $rowtl['pt3'] + $rowtl['pt4'] + $rowtl['pt5'];
    $pre_tl_quiztotal = $rowtl['quiz1'] +  $rowtl['quiz2'] + $rowtl['quiz3'] + $rowtl['quiz4'] + $rowtl['quiz5'];

    $teacherlabel1=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$newid' AND term='Midterm' AND subid='$subid'");
    $rowtl1=mysqli_fetch_assoc($teacherlabel1);

    $mid_tltotal = $rowtl1['pt1'] +  $rowtl1['pt2'] + $rowtl1['pt3'] + $rowtl1['pt4'] + $rowtl1['pt5'];
    $mid_tl_quiztotal = $rowtl1['quiz1'] +  $rowtl1['quiz2'] + $rowtl1['quiz3'] + $rowtl1['quiz4'] + $rowtl1['quiz5'];

    $teacherlabel2=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$newid' AND term='Prefinal' AND subid='$subid'");
    $rowtl2=mysqli_fetch_assoc($teacherlabel2);

    $pref_tltotal = $rowtl2['pt1'] +  $rowtl2['pt2'] + $rowtl2['pt3'] + $rowtl2['pt4'] + $rowtl2['pt5'];
    $pref_tl_quiztotal = $rowtl2['quiz1'] +  $rowtl2['quiz2'] + $rowtl2['quiz3'] + $rowtl2['quiz4'] + $rowtl2['quiz5'];

    $teacherlabel3=mysqli_query($conn,"SELECT * FROM teacher_label WHERE teachid='$newid' AND term='Final' AND subid='$subid'");
    $rowtl3=mysqli_fetch_assoc($teacherlabel3);

    $final_tltotal = $rowtl3['pt1'] +  $rowtl3['pt2'] + $rowtl3['pt3'] + $rowtl3['pt4'] + $rowtl3['pt5'];
    $final_tl_quiztotal = $rowtl3['quiz1'] +  $rowtl3['quiz2'] + $rowtl3['quiz3'] + $rowtl3['quiz4'] + $rowtl3['quiz5'];

    /* --------------------------------------------------------------------------------------------------------------------------------- */

    /* prelim */
    $prelim = mysqli_query($conn,"SELECT * FROM student_prelim WHERE studid='$studid' AND subid = '$subid'");
    $row = mysqli_fetch_array($prelim);

    $pre_pt = $row['pt1'] + $row['pt2'] + $row['pt3'] + $row['pt4'] + $row['pt5'];
    $pre_quiz = $row['quiz1'] + $row['quiz2'] + $row['quiz3'] + $row['quiz4'] + $row['quiz5'];
    $pre_exam = $row['exam1'];

    $pre_pttotal =  $pre_pt;
    $pre_quiztotal =  $pre_quiz + 50;
    $pre_examtotal = $pre_exam + 50;

    $pre_ptequi = ($rowgsheets['class_standing']/100) * $pre_pttotal;
    $pre_quizequi = ($rowgsheets['quizzes']/100) * $pre_quiztotal;
    $pre_examequi = ($rowgsheets['practical_exam']/100) * $pre_examtotal;

    $prelimtotal = $pre_ptequi + $pre_quizequi + $pre_examequi;
    /* prelim */

    /* midterm */
    $midterm = mysqli_query($conn,"SELECT * FROM student_midterm WHERE studid='$studid' AND subid = '$subid'");
    $row1 = mysqli_fetch_array($midterm);

    
    $mid_pt = $row1['pt1'] + $row1['pt2'] + $row1['pt3'] + $row1['pt4'] + $row1['pt5'];
    $mid_quiz = $row1['quiz1'] + $row1['quiz2'] + $row1['quiz3'] + $row1['quiz4'] + $row1['quiz5'];
    $mid_exam = $row1['exam1'];

    $mid_pttotal = $mid_pt + 50;
    $mid_quiztotal =  $mid_quiz + 50;
    $mid_examtotal = $mid_exam + 50;

    $mid_ptequi = ($rowgsheets['class_standing']/100) * $mid_pttotal;
    $mid_quizequi = ($rowgsheets['quizzes']/100) * $mid_quiztotal;
    $mid_examequi = ($rowgsheets['practical_exam']/100) * $mid_examtotal;

    $midtermtotal = $mid_ptequi + $mid_quizequi + $mid_examequi;

    /* midterm */

    /* prefinal */

    $prefinal = mysqli_query($conn,"SELECT * FROM student_prefinal WHERE studid='$studid' AND subid = '$subid'");
    $row2 = mysqli_fetch_array($prefinal);
  
    $pref_pt = $row2['pt1'] + $row2['pt2'] + $row2['pt3'] + $row2['pt4'] + $row2['pt5'];
    $pref_quiz = $row2['quiz1'] + $row2['quiz2'] + $row2['quiz3'] + $row2['quiz4'] + $row2['quiz5'];
    $pref_exam = $row2['exam1'];

    $pref_pttotal =  $pref_pt + 50;
    $pref_quiztotal =  $pref_quiz + 50;
    $pref_examtotal = $pref_exam + 50;

    $pref_ptequi = ($rowgsheets['class_standing']/100) * $pref_pttotal;
    $pref_quizequi = ($rowgsheets['quizzes']/100) * $pref_quiztotal;
    $pref_examequi = ($rowgsheets['practical_exam']/100) * $pref_examtotal;

    $prefinaltotal = $pref_ptequi + $pref_quizequi + $pref_examequi;
    /* prefinal */

    /* final */
    $final = mysqli_query($conn,"SELECT * FROM student_final WHERE studid='$studid' AND subid = '$subid'");
    $row3 = mysqli_fetch_array($final);

    $final_pt = $row3['pt1'] + $row3['pt2'] + $row3['pt3'] + $row3['pt4'] + $row3['pt5'];
    $final_quiz = $row3['quiz1'] + $row3['quiz2'] + $row3['quiz3'] + $row3['quiz4'] + $row3['quiz5'];
    $final_exam = $row3['exam1'];

    $final_pttotal =  $final_pt + 50;
    $final_quiztotal =  $final_quiz + 50;
    $final_examtotal = $final_exam + 50;

    $final_ptequi = ($rowgsheets['class_standing']/100) * $final_pttotal;
    $final_quizequi = ($rowgsheets['quizzes']/100) * $final_quiztotal;
    $final_examequi = ($rowgsheets['practical_exam']/100) * $final_examtotal;

    $finaltotal = $final_ptequi + $final_quizequi + $final_examequi;
    /* final */
?>