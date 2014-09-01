<?php

require '../teacher/include/autoinclude.php'; 

$fillsect = $_GET['fillsect'];

autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

if (empty($fillsect)) {
    $fillsect = "classmeta";   
}

if ($fillsect == "classmeta") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%; min-width: 20px;">
    10% Complete
  </div>
</div>

<h1>Create a class</h1>

<p>Creating a class is easy, after discussing what should go in each group with your students, fill out each box with your decided actions.</p>
<p>Select some times for students to action the What are you Doing survey, and create the class.</p> <br>

<form method="post" action="create-class.php?fillsect=firstgroup" enctype="application/x-www-form-urlencoded">

<p><strong>Class Name</strong> give your class a name so you can remember what you were doing. <br>
    <input name="className" type="text" class="form-control" placeholder="Yr 8 - Maths 1A" required></p>
    
<p><strong>Class Date</strong> select a date for your class, it doesn't have to be correct. <br>
    <input name="classDate" type="date" class="form-control" placeholder="2014-01-01" required></p>
    
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-right"></span> Next Step</button>
</form>
<?php  
} elseif ($fillsect == "firstgroup") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
    30% Complete
  </div>
</div>

<form method="post" action="create-class.php?fillsect=secondgroup" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="className" value="<?=$_POST['className']?>">
<input type="hidden" name="classDate" value="<?=$_POST['classDate']?>">
    
<h3>Group I - Time at school</h3>

<p><strong>A:</strong> <input name="g1f1" type="text" class="form-control" placeholder="Break - toilet, fruit, change up" required="required"></p>
<p><strong>B:</strong> <input name="g1f2" type="text" class="form-control" placeholder="Off Task - day dreaming, fillding, talking/listening about something other than the task, passing notes" required="required"></p>
<p><strong>C:</strong> <input name="g1f3" type="text" class="form-control" placeholder="Procrastinating" required="required"></p>
<p><strong>D:</strong> <input name="g1f4" type="text" class="form-control" placeholder="Changing between tasks" required="required"></p>
<p><strong>E:</strong> <input name="g1f5" type="text" class="form-control" placeholder="Etc" required="required"></p>
<p><strong>F:</strong> <input name="g1f6" type="text" class="form-control" placeholder="Etc" required="required"></p>
<p><strong>G:</strong> <input name="g1f7" type="text" class="form-control" placeholder="Etc" required="required"></p>

<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-right"></span> Next Step</button>
</form>
<?php  
} elseif ($fillsect == "secondgroup") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
    55% Complete
  </div>
</div>

<form method="post" action="create-class.php?fillsect=thirdgroup" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="className" value="<?=$_POST['className']?>">
<input type="hidden" name="classDate" value="<?=$_POST['classDate']?>">
<input type="hidden" name="g1f1" value="<?=$_POST['g1f1']?>">
<input type="hidden" name="g1f2" value="<?=$_POST['g1f2']?>">
<input type="hidden" name="g1f3" value="<?=$_POST['g1f3']?>">
<input type="hidden" name="g1f4" value="<?=$_POST['g1f4']?>">
<input type="hidden" name="g1f5" value="<?=$_POST['g1f5']?>">
<input type="hidden" name="g1f6" value="<?=$_POST['g1f6']?>">
<input type="hidden" name="g1f7" value="<?=$_POST['g1f7']?>">

<h3>Group II - Time on task</h3>

<p><strong>A:</strong> <input name="g2f1" type="text" class="form-control" placeholder="Getting organised" required="required"></p>
<p><strong>B:</strong> <input name="g2f2" type="text" class="form-control" placeholder="Doing something I'm not thinking about - copying, colouring, decorating, ruling up" required="required"></p>
<p><strong>C:</strong> <input name="g2f3" type="text" class="form-control" placeholder="Doing something I can already do" required="required"></p>
<p><strong>D:</strong> <input name="g2f4" type="text" class="form-control" placeholder="Planning and preparing for the task" required="required"></p>
<p><strong>E:</strong> <input name="g2f5" type="text" class="form-control" placeholder="Finding stuff need" required="required"></p>
<p><strong>F:</strong> <input name="g2f6" type="text" class="form-control" placeholder="Etc" required="required"></p>
<p><strong>G:</strong> <input name="g2f7" type="text" class="form-control" placeholder="Etc" required="required"></p>

<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-right"></span> Next Step</button>
</form>    
<?php  
} elseif ($fillsect == "thirdgroup") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
    70% Complete
  </div>
</div>

<form method="post" action="create-class.php?fillsect=selecttimers" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="className" value="<?=$_POST['className']?>">
<input type="hidden" name="classDate" value="<?=$_POST['classDate']?>">
<input type="hidden" name="g1f1" value="<?=$_POST['g1f1']?>">
<input type="hidden" name="g1f2" value="<?=$_POST['g1f2']?>">
<input type="hidden" name="g1f3" value="<?=$_POST['g1f3']?>">
<input type="hidden" name="g1f4" value="<?=$_POST['g1f4']?>">
<input type="hidden" name="g1f5" value="<?=$_POST['g1f5']?>">
<input type="hidden" name="g1f6" value="<?=$_POST['g1f6']?>">
<input type="hidden" name="g1f7" value="<?=$_POST['g1f7']?>">
<input type="hidden" name="g2f1" value="<?=$_POST['g2f1']?>">
<input type="hidden" name="g2f2" value="<?=$_POST['g2f2']?>">
<input type="hidden" name="g2f3" value="<?=$_POST['g2f3']?>">
<input type="hidden" name="g2f4" value="<?=$_POST['g2f4']?>">
<input type="hidden" name="g2f5" value="<?=$_POST['g2f5']?>">
<input type="hidden" name="g2f6" value="<?=$_POST['g2f6']?>">
<input type="hidden" name="g2f7" value="<?=$_POST['g2f7']?>">
    
<h3>Group III - Time learning</h3>

<p><strong>A:</strong> <input name="g3f1" type="text" class="form-control" placeholder="Thinking about planning how to do the task" required="required"></p>
<p><strong>B:</strong> <input name="g3f2" type="text" class="form-control" placeholder="Reading, listening, collecting new information" required="required"></p>
<p><strong>C:</strong> <input name="g3f3" type="text" class="form-control" placeholder="Talking about ideas or new information" required="required"></p>
<p><strong>D:</strong> <input name="g3f4" type="text" class="form-control" placeholder="Asking the teacher and peers questions" required="required"></p>
<p><strong>E:</strong> <input name="g3f5" type="text" class="form-control" placeholder="Writing, drawing" required="required"></p>
<p><strong>F:</strong> <input name="g3f6" type="text" class="form-control" placeholder="Working on the computer / iPad" required="required"></p>
<p><strong>G:</strong> <input name="g3f7" type="text" class="form-control" placeholder="Thinking about the topic, questioning, connecting ideas" required="required"></p>

<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-right"></span> Next Step</button>
</form>
<?php  
} elseif ($fillsect == "selecttimers") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
    85% Complete
  </div>
</div>

<form method="post" action="create-class.php?fillsect=settimers" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="className" value="<?=$_POST['className']?>">
<input type="hidden" name="classDate" value="<?=$_POST['classDate']?>">
<input type="hidden" name="g1f1" value="<?=$_POST['g1f1']?>">
<input type="hidden" name="g1f2" value="<?=$_POST['g1f2']?>">
<input type="hidden" name="g1f3" value="<?=$_POST['g1f3']?>">
<input type="hidden" name="g1f4" value="<?=$_POST['g1f4']?>">
<input type="hidden" name="g1f5" value="<?=$_POST['g1f5']?>">
<input type="hidden" name="g1f6" value="<?=$_POST['g1f6']?>">
<input type="hidden" name="g1f7" value="<?=$_POST['g1f7']?>">
<input type="hidden" name="g2f1" value="<?=$_POST['g2f1']?>">
<input type="hidden" name="g2f2" value="<?=$_POST['g2f2']?>">
<input type="hidden" name="g2f3" value="<?=$_POST['g2f3']?>">
<input type="hidden" name="g2f4" value="<?=$_POST['g2f4']?>">
<input type="hidden" name="g2f5" value="<?=$_POST['g2f5']?>">
<input type="hidden" name="g2f6" value="<?=$_POST['g2f6']?>">
<input type="hidden" name="g2f7" value="<?=$_POST['g2f7']?>">
<input type="hidden" name="g3f1" value="<?=$_POST['g3f1']?>">
<input type="hidden" name="g3f2" value="<?=$_POST['g3f2']?>">
<input type="hidden" name="g3f3" value="<?=$_POST['g3f3']?>">
<input type="hidden" name="g3f4" value="<?=$_POST['g3f4']?>">
<input type="hidden" name="g3f5" value="<?=$_POST['g3f5']?>">
<input type="hidden" name="g3f6" value="<?=$_POST['g3f6']?>">
<input type="hidden" name="g3f7" value="<?=$_POST['g3f7']?>">

<h3>Timer Settings</h3>
<p>Timers are an integral part of What are you Doing. We reccomend a minumum of ten, however, you can set your own accordingly.</p>

<p><strong>Timers</strong> set the number of timers. <br>
    <input type="number" name="timernum" class="form-control" placeholder="10" min="5" max="20" value="10" required>
    <br><small>Minimum: 5, Maximum: 20.</small></p>
    
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-right"></span> Next Step</button>
</form>
<?php  
} elseif ($fillsect == "settimers") {
?>

<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">
    95% Complete
  </div>
</div>

<form method="post" action="class_format.php" enctype="application/x-www-form-urlencoded">

<input type="hidden" name="className" value="<?=$_POST['className']?>">
<input type="hidden" name="classDate" value="<?=$_POST['classDate']?>">
<input type="hidden" name="g1f1" value="<?=$_POST['g1f1']?>">
<input type="hidden" name="g1f2" value="<?=$_POST['g1f2']?>">
<input type="hidden" name="g1f3" value="<?=$_POST['g1f3']?>">
<input type="hidden" name="g1f4" value="<?=$_POST['g1f4']?>">
<input type="hidden" name="g1f5" value="<?=$_POST['g1f5']?>">
<input type="hidden" name="g1f6" value="<?=$_POST['g1f6']?>">
<input type="hidden" name="g1f7" value="<?=$_POST['g1f7']?>">
<input type="hidden" name="g2f1" value="<?=$_POST['g2f1']?>">
<input type="hidden" name="g2f2" value="<?=$_POST['g2f2']?>">
<input type="hidden" name="g2f3" value="<?=$_POST['g2f3']?>">
<input type="hidden" name="g2f4" value="<?=$_POST['g2f4']?>">
<input type="hidden" name="g2f5" value="<?=$_POST['g2f5']?>">
<input type="hidden" name="g2f6" value="<?=$_POST['g2f6']?>">
<input type="hidden" name="g2f7" value="<?=$_POST['g2f7']?>">
<input type="hidden" name="g3f1" value="<?=$_POST['g3f1']?>">
<input type="hidden" name="g3f2" value="<?=$_POST['g3f2']?>">
<input type="hidden" name="g3f3" value="<?=$_POST['g3f3']?>">
<input type="hidden" name="g3f4" value="<?=$_POST['g3f4']?>">
<input type="hidden" name="g3f5" value="<?=$_POST['g3f5']?>">
<input type="hidden" name="g3f6" value="<?=$_POST['g3f6']?>">
<input type="hidden" name="g3f7" value="<?=$_POST['g3f7']?>">   
    
<h3>Specify Timers</h3>
<p>Select the times you wish to interrupt the class to complete the survey. You do not have to use all 10 timers, though we reccomend it.</p>

<?php
$t = 1;
$wl = $_POST[timernum] + 1;
while ($wl > 0) { 
    echo "<p><strong>Timer $t:</strong><br> <input name=\"t$t\" type=\"datetime-local\" class=\"form-control\" required=\"required\"><br><small>Format: dd/mm/yyyy hh:mm am/pm</small></p>";
    $t++;
    
    if ($t == $wl) {
        $wl = 0;
    }
}
?>
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-chevron-ok"></span> Create Class</button>
    
<script type="text/javascript">

  var i = document.createElement("input");
  i.setAttribute("type", "date");
  if (i.type == "text") {
      alert("Uh oh. Looks like your browser doesn't have a date/time chooser. Make sure when you type in the date and time, you follow the format suggestion. Alternatively, use an iPad, Google Chrome, or Apple Safari.");
  }

</script>    

</form>
<?php    
}

create_footer();

?>