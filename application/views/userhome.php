<table class="table table-bordered">
<?php
$num = sizeof($data);
for($i=0;$i<$num;$i++)
{
	if($sub=="poll") {?>
		<tr><td><?php  echo "<h3>".$data[$i]->title."</h3>";?>
		<?php echo "<p><b>Author: </b>".$data[$i]->author."</p>";?></td></tr>
	<?php } elseif ($sub=="story") {?>
		<tr><td><?php  echo "<h3>".$data[$i]->title."</h3>";?>
		<?php echo "<p><b>Author: </b>".$data[$i]->author."</p>";?>
		<?php echo "<p><b>Story: </b>".$data[$i]->story_text."</p>";?></td></tr>
	<?php } elseif ($sub=="comment") {?>
		<tr><td><?php  echo "<p><b>Comment: </b>".$data[$i]->comment_text."</p>";?>
		<?php echo "<p><b>Author: </b>".$data[$i]->author."</p>";?></td></tr>
	<?php }
} ?>
</table>