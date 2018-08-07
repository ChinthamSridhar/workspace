
<style>
.table tbody tr td:not(:first-child) {
  border: 1px solid blue;
  width: 1em;
  height:1em;
}

.table tbody tr td:first-child {
  font-weight:bold;
}

.table tr td:nth-child(7) {
  border:none!important;
}

.table {
  border-spacing: 3em;
}
</style>
<?php
session_start();
include 'config.php';
$query ="select available_seats from theatre_seats WHERE theatre_id=2";
print_r($query);die;
$result = mysqli_query($conn,$query);
?>
<table class="table">
<thead>
  <tr>
      <td></td>
      for($i=1;$i=10;$i++){
      
      <td>$i</td>
      }
    
      
      
      
      
      <td></td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td></td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
  </tr>
</thead>
<tbody>
  <tr>
    <td>A</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
    
      
  </tr>
  <tr>
    <td>B</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>C</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>D</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  <tr>
    <td>E</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
</tbody>
</table>
