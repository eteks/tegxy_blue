<table width="190" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <?php if($_REQUEST['action']!='view') { ?>
      <td align="center">
       <?php if (($CheckModulePrevilage[2]==1) || ($CheckModulePrevilage[3]==1 && $_REQUEST['action']=='edit')) {?>
      <input type="submit" name="<?php echo $submitName ?>" id="<?php echo $submitName ?>"  value="<?php if($_REQUEST['action']=='edit'){ ?>Update<?php }else{?>Submit<?php }?>" class="menu" /><?php } ?>
      </td>
       <?php } ?>
      <td align="center">&nbsp;</td>
      <td align="center" >
      <?php if (($CheckModulePrevilage[2]==1) || ($CheckModulePrevilage[3]==1 && $_REQUEST['action']=='edit') || ($CheckModulePrevilage[1]==1)) {?>
      <input type="button" name="Reset" id="Reset" value="Reset" class="menu" onClick="return OnclickMenu('0','<?php echo $ModuleId; ?>','<?php echo $fileName ?>');" />
      <?php } ?>
      </td>
      <td align="center">&nbsp;</td>
      <td align="center"><input type="button" id="Cancel" name="Cancel" value="Cancel" class="menu" onClick="return cancelpage();" /></td>
    </tr>
</table>