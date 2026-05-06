<table class="table table-bordered table-sm">
    <thead  class="text-center">
        <tr>
            <!-- <th><?php echo $course.'-'.$year;?></th> -->
            <th colspan="18"></th>
            <th colspan="4">Computation</th>
        </tr>
        <tr>
            <th width="10%"><?php echo $subjectcode;?></th>
            <th width="1%" colspan="7">Performance Task <?php echo $rowgsheets['class_standing'];?>%</th>
            <th width="1%" colspan="7">Quizzes <?php echo $rowgsheets['quizzes'];?>%</th>
            <th width="1%" colspan="3">Written Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
            <th width="1%">P.T</th>
            <th width="1%">Q</th>
            <th width="1%">W</th>
            <th width="1%">Prelim</th>
        </tr>
        <tr>
            <th rowspan="2">Student Name</th>
            <th width="1%">1</th>
            <th width="1%">2</th>
            <th width="1%">3</th>
            <th width="1%">4</th>
            <th width="1%">5</th>
            <th width="1%" >Total</th>
            <th width="1%" id="g_green" rowspan="2">Equi</th>
            <th width="1%">1</th>
            <th width="1%">2</th>
            <th width="1%">3</th>
            <th width="1%">4</th>
            <th width="1%">5</th>
            <th width="1%">Total</th>
            <th width="1%" id="g_green" rowspan="2">Equi</th>
            <th width="1%">1</th>
            <th width="1%">Total</th>
            <th width="1%" id="g_green" rowspan="2">Equi</th>
            <th><?php echo $rowgsheets['class_standing'];?>%</th>
            <th width="1%"><?php echo $rowgsheets['quizzes'];?>%</th>
            <th width="1%"><?php echo $rowgsheets['practical_exam'];?>%</th>
            <th width="1%" id="g_green">Total</th>
        </tr>
        <tr style="background-color: yellow;">
            <?php  for($i = 1; $i <= 5; $i++){
            echo "<th width='1%'>".$rowtl['pt'.$i]."</th>";
            }?>

            <th width="1%" ><?php echo $pre_tltotal;?></th>

            <?php  for($i = 1; $i <= 5; $i++){
            echo "<th width='1%'>".$rowtl['quiz'.$i]."</th>";
            }?>

            <th width="1%"><?php echo $pre_tl_quiztotal;?></th>
            <th width="1%"><?php echo $rowtl['exam']; ?></th>
            <th width="1%"><?php echo $rowtl['exam']; ?></th>
            <th><?php echo $pre_tltotal;?></th>
            <th width="1%"><?php echo $pre_tl_quiztotal;?></th>
            <th width="1%"><?php echo $rowtl['exam'];?></th>
            <th width="1%"><?php echo $pre_tltotal + $pre_tl_quiztotal + $rowtl['exam'];?></th>
        </tr>
    </thead>
        <?php
        $grades=mysqli_query($conn,"SELECT * FROM student_prelim WHERE subid='$subjectid' AND sy='$subjectsy'");
        while($rowgrades=mysqli_fetch_assoc($grades)){
            $studentinfo=mysqli_query($conn,"SELECT * FROM student WHERE id='".$rowgrades['studid']."'");
            $rowinfo=mysqli_fetch_assoc($studentinfo);
        ?>
    <tbody  class="text-center">
        <td><?php echo $rowinfo['lname'];?> <?php echo $rowinfo['mname'];?>. <?php echo $rowinfo['fname'];?></td>
        <?php
            $pttotal = 0;
            $quiztotal = 0;

            for($i = 1; $i<=5; $i++){
                echo '<td>'.$rowgrades['pt'.$i].'</td>';

                $pttotal += $rowgrades['pt'.$i];
            }
            $pttotal += 50;
            echo '<td>'.$pttotal.'</td>';
            $pttotal = ($rowgsheets['class_standing']/100) * $pttotal;
            $pttotal = round($pttotal);
            echo '<td id="g_green">'.$pttotal.'</td>';

            for($x=1; $x<=5; $x++){
                echo '<td>'.$rowgrades['quiz'.$x].'</td>';
                $quiztotal += $rowgrades['quiz'.$x];
            }
            $quiztotal += 50;

            echo '<td>'.$quiztotal.'</td>';
            $quiztotal = ($rowgsheets['quizzes']/100) * $quiztotal;
            $quiztotal = round($quiztotal);
            echo '<td id="g_green">'.$quiztotal.'</td>';
        ?>
        <td><?php echo $rowgrades['exam1'];?></td>
        <td><?php echo $totalexam = $rowgrades['exam1']+50;?></td>
        <td id="g_green"><?php $totalexam = ($rowgsheets['practical_exam']/100) * $totalexam; echo round($totalexam);?></td>
        <td><?php echo round($pttotal);?></td>
        <td><?php echo round($quiztotal);?></td>
        <td><?php echo round($totalexam);?></td>
        <td id="g_green"><?php $pretotal = $pttotal + $quiztotal + $totalexam; echo round($pretotal);?></td>
    </tbody>
    <?php
    }
    ?>
</table>