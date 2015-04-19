<tr>
    <td  id="<?php echo $row[0]; ?>">
        <b><?php echo $row[1]; ?> </b>
    </td>
    <td>
        <input type="radio" class='klicove_slovo' name="<?php echo $row[0]; ?>" value="1">
        ne 
        <input type="radio" class='klicove_slovo' name="<?php echo $row[0]; ?>" value="2">spíše ne 
        <input type="radio" class='klicove_slovo' name="<?php echo $row[0]; ?>" value="3" checked="checked">nevadí mi
        <input type="radio" class='klicove_slovo' name="<?php echo $row[0]; ?>" value="4">spíše ano  
        <input type="radio" class='klicove_slovo' name="<?php echo $row[0]; ?>" value="5">
        ano
    </td>
</tr>
