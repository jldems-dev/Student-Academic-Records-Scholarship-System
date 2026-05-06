<?php
include "../config.php";
    $schnameid = $_GET['sch_nameid'];

    
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=student_applicants_list.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	$output = "";
 
	$output .="
    <table>
        <thead>
            <tr>
                <th>Student ID No.</th>
                <th>Last Name</th>
                <th>Given Name</th>
                <th>Extention Name</th>
                <th>Middle Name</th>
                <th>Sex</th>
                <th>Birthday</th>
                <th>Course</th>
                <th>Year</th>
                <th>Fathers Name</th>
                <th>Mothers Name</th>
                <th>DSWD HOUSEHOLD NO.</th>
                <th>HOUSEHOLD PER CAPITA INCOME</th>
                <th>STREET & BARANGAY</th>
                <th>ZIPCODE</th>
                <th>TOTAL ASS. 1ST SEM</th>
                <th>TOTAL ASS. 2ND SEM</th>
                <th>DISABILITY</th>
                <th>CCT. NO.</th>
                <th>EMAIL</th>
                <th>SCHOOL YEAR</th>
            </tr>
        </thead>
        <tbody>
	";
 
	$stud_app=mysqli_query($conn,"SELECT * FROM sch_applctionform WHERE sch_nameid='$schnameid'");
    while($rowstud_list=mysqli_fetch_assoc($stud_app)){
 
	$output .= "
        <tr>
            <td>".$rowstud_list['stud_idnum']."</td>
            <td>".$rowstud_list['last_name']."</td>
            <td>".$rowstud_list['given_name']."</td>
            <td>". $rowstud_list['ext_name']."</td>
            <td>". $rowstud_list['middle_name']."</td>
            <td>". $rowstud_list['sex']."</td>
            <td>". $rowstud_list['bday']."</td>
            <td>". $rowstud_list['course']."</td>
            <td>". $rowstud_list['year_lvl']."</td>
            <td>". $rowstud_list['f_lname'].", ". $rowstud_list['f_gname']." ". $rowstud_list['f_mname']."</td>
            <td>". $rowstud_list['m_lname'].", ". $rowstud_list['m_gname']." ". $rowstud_list['m_mname']."</td>
            <td>". $rowstud_list['dswd_hsno']."</td>
            <td>". $rowstud_list['hsh_no']."</td>
            <td>". $rowstud_list['brgy']."</td>
            <td>". $rowstud_list['zpcode']."</td>
            <td>". $rowstud_list['first_sem']."</td>
            <td>". $rowstud_list['second_sem']."</td>
            <td>". $rowstud_list['dsblty']."</td>
            <td>". $rowstud_list['cntct_num']."</td>
            <td>". $rowstud_list['email_add']."</td>
            <td>". $rowstud_list['sy']."</td>
        </tr>
	";
	}
 
	$output .="
			</tbody>
		</table>
	";
 
	echo $output; 
 
 
?>