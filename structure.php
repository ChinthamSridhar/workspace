<?php
for($i=1;$i<=10;$i++){
    if($i >= 6){
        echo "<th></th><th></th><th></th><th></th><th></th><th></th>";?>
        <th><?php echo $i;?></th> 
        <?php
    }else{
    ?>
        <th><?php echo $i;?></th> 
        <th></th>
        <th></th>
        <th></th>
        <th></th>
   <?php
}
}  
 