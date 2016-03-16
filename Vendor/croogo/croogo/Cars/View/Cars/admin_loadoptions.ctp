<?php 
echo "<option value=\"\">-- Select --</option>\n";
foreach($optionList as $k => $v) {
 echo "<option value=\"$k\">$v</option>\n";
}
?>