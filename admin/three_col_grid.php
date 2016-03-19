<?php
$WhereCont=(isset($WhereCont) && !empty($WhereCont) ? trim($WhereCont) : '');
	$sqltot=$all_Sql.$WhereCont;
	$tot=mysql_query($sqltot);
	$rtot=@mysql_num_rows($tot);
	$totalrecord=$rtot;  $pagesize=10;
	$noofpages=$totalrecord/$pagesize;
	if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
	$startdata=0;
	else
	$startdata=$_REQUEST['startdata'];
	$count=$startdata;
        $_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
  
	if($_REQUEST["startdata"]=="0")
	{	$i=1; 	}
	elseif($_REQUEST["startdata"]!="0")
	{ 	$i=$_REQUEST["startdata"]+1; 	}
	else
	{ 	$i=1; }
	$Register_Select=$all_Sql.$WhereCont." order by ".$orderBy." DESC limit $startdata,$pagesize";
	$Register_Result=db_query($Register_Select);
	$Register_Result_count=db_num_rows($Register_Result);
	if($Register_Result_count==0 && $startdata!='0')
	{
		$startdate=$_REQUEST['startdata']-1;
		header("location:".$fileName.".php?startdata=".$startdate);
	}
	$CountRegister=@db_num_rows($Register_Result);
	$Sno=$startdata +1;
	
	// echo 'sdfasdf'.$CheckModulePrevilage[3];
 ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7" align="left" valign="top"><img src="images/gridbox/sub_l_bg.gif" width="7" height="28" /></td>
                <td align="left" valign="top" class="sub_title"><?php echo $gridHead ?></td>
                <td width="6" align="right" valign="top"><img src="images/gridbox/sub_r_bg.gif" width="6" height="28" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#1e1e1e">
              <tr>
                <td align="left" valign="top" class="td"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10" align="left" valign="top"><img src="images/gridbox/grid_l_bg.gif" width="10" height="27" /></td>
                        <td align="left" class="gridmenu">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                          <tr>
                                <td width="5%"  align="center" valign="top"><?php echo $colHead[0] ?></td>
                                <td width="30%" align="center" valign="top"><?php echo $colHead[1] ?></td>
                                <td width="22%" align="center" valign="top"><?php echo $colHead[2] ?></td>
                                <td width="20%" align="center" valign="top"><?php echo $colHead[3] ?></td>
                                <?php if(isset($Verified) && !empty($Verified)) if($Verified=='A'){
								$colspan=6;
								?>
                                <td align="center" valign="top"><?php echo $colHead[4] ?></td>
                                <td width="23%" align="center" valign="top"><?php echo $colHead[5] ?></td>
                                <?php } else {
								$colspan=5;
								?>
                                <td width="23%" align="center" valign="top"><?php echo $colHead[4] ?></td>
                                <?php }?>
                               
                          </tr>
                        </table>
                        </td>
                        <td width="7" align="right" valign="top"><img src="images/gridbox/gird_r-bg.gif" width="7" height="27" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="tdmsg"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                      <tr>
                        <td colspan="4"  height="2"></td>
                      </tr>
                      <?php	while($Register_Fetch=db_fetch_array($Register_Result))
                        { 
                        	// echo "status",$Register_Fetch['PS_Status']; 	?>
                        <?php $id=$Register_Fetch['0']; 
                              $startdata=isset($_REQUEST['startdata'])?$_REQUEST['startdata']:0; ?>
                      <tr id="tr_<?php echo $id ?>" <?php if(isset($optId) && !empty($optId)) if ($id == $optId) echo 'style="font-weight:bold; color: orange;"'; 
					  else if ($_REQUEST['id'] == $id) echo 'style="color: #ffff00;"';
					  else echo 'style="color: #fff;"'; ?>>
                        <td width="5%" align="center" class="gridtxt1"><?php echo $Sno; ?></td>
                        <td width="30%" align="center" class="gridtxt1"><?php echo $Register_Fetch[1]; ?></td>
                        <?php if(isset($SectorName) && !empty($SectorName)) if($SectorName == 'yes'){?>
                        <td width="22%" align="center" class="gridtxt1"><?php echo ShowSectName($Register_Fetch[2]); ?></td>
                        <?php } else {?>
                        <td width="22%" align="center" class="gridtxt1"><?php echo $Register_Fetch[2]; ?></td>
                        <?php }?>
                        <td width="20%" align="center" class="gridtxt1">
						<?php 
							// if($CheckModulePrevilage[3]==1)
							// {
							// 	if($Register_Fetch[3]==1)
							// 	{ 
							// 		echo "<span  onclick=\"return OnClickStatusInActive('$id','$startdata')\" style=\"text-decoration:underline;cursor:pointer\">Active</span>";
							// 	}
							// 	else
							// 	{
							// 		echo "<span  onclick=\"return OnClickStatusActive('$id','$startdata')\" style=\"text-decoration:underline;cursor:pointer\">In-Active</span>";
							// 	}  
							// }
								if($Register_Fetch['PS_Status']==1)
								{ 
									echo "<span  onclick=\"return OnClickStatusInActive('$id','$startdata')\" style=\"text-decoration:underline;cursor:pointer\">Active</span>";
								}
								else
								{
									echo "<span  onclick=\"return OnClickStatusActive('$id','$startdata')\" style=\"text-decoration:underline;cursor:pointer\">In-Active</span>";
								}  
							?>
						</td>
                      </tr>
                      <tr>
                        <td height="2" colspan="5" align="center"></td>
                      </tr>
                      <?php $Sno++;} 
					  if($Register_Result_count==0){ ?>
                      <tr><td colspan="5" align="center" class="gridtxt1" style="color:#FFFFFF">No Record Found</td></tr>
                    <?php } ?>
                      <tr>
                        <td height="30" colspan="<?php echo $colspan;?>" align="right" style="padding:0 15px 0 0;">
                        <table border="0" cellspacing="0" cellpadding="0">
                      <tr><?php
						$s = $startdata/$pagesize;
						$p = ($startdata-$pagesize) / $pagesize;
						$n = ($startdata+$pagesize) / $pagesize;
						$curpage = $startdata/$pagesize;
								
						if ($curpage < 5)
						{
							$startlmt = 0;
							$endlmt   = 9;
							
							$dd = (int) $noofpages;
							if ($dd < $noofpages)
							$dd = $dd+1;
							else
							$dd = (int)$noofpages;
							
							if ($dd < $endlmt)
							$endlmt = $dd;
						}
						else
						{
							$startlmt = $s - 4;
							$endlmt   = $s + 5;
							if ($endlmt > $noofpages)
							{
								$dd = (int) $noofpages;
								if ($dd < $noofpages)
								$endlmt = $dd+1;
								else
								$endlmt = (int)$noofpages;
								$startlmt = $endlmt - 10;
								if ($startlmt < 0)
								$startlmt = 0;
							}
						}
								if (($noofpages > 1))
								{
									if($startdata==0) 
									echo "<td width='35' align='center' class='gridclr'>First</td>";
									else
									echo "<td width='35' align='center' class='grid'><a onclick=\"return OnClickPage('0'); \" style=\"cursor:pointer\" ><b> First</b></a></td>";
								}
								
								if($startdata!=0) 
								{
									$prev=$startdata-$pagesize;
									echo "<td width='35' align='center' class='grid'><a onclick=\"return OnClickPage('$prev'); \" style=\"cursor:pointer\" ><b> Prev</b></a></td>";
								}
								for ($i=$startlmt;$i<$endlmt;$i++)
								{
									$pageno=$i+1; $j=($pagesize*$pageno)-$pagesize;
									if ($startdata==0 && $i==0) { echo "<td width='10' align='center' class='gridclr'>". $pageno."</td>"; }
									else
									{
										if($startdata == ($pagesize*($pageno))-$pagesize)
										{
											echo "<td width='10' align='center' class='gridclr'>&nbsp;". $pageno."</td>";
											$curpage = $pageno;
										}
										else
										{
											echo "<td width='10' align='center' class='grid'><a onclick=\"return OnClickPage('$j'); \" style=\"cursor:pointer\" >&nbsp;". $pageno. "</a></td>";
										}
									}
								}
									
								if($startdata+$pagesize<$totalrecord)
								{
									$next=$startdata+$pagesize;
									echo "<td width='35' align='center' class='grid'><a onclick=\"return OnClickPage('$next'); \" style=\"cursor:pointer\" >Next</a></td>";
								}
										
								if ($noofpages > 1)
								{
									$tot = $totalrecord/$pagesize;
									$tt  = (int) $tot;
									if ($tt == $tot)
										$last = $tt*$pagesize-$pagesize;
									else
									{
										$last = $tt*$pagesize;
										$tt = $tt + 1;
									}
									if ($curpage == $tt)
									echo "<td width='10' align='center' class='gridclr'>&nbsp;<b>Last</b></td>";
									else
									echo "<td width='35' align='center' class='grid'><a onclick=\"return OnClickPage('$last'); \" style=\"cursor:pointer\"><b> Last </b></a></td>";
								}
							?>
                        </tr>
                    </table>
                   		</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="6" width="7" align="left"><img src="images/gridbox/grid_l_bt.gif" width="7" height="6" /></td>
                        <td height="6" background="images/gridbox/grid_m_bt.gif"></td>
                        <td height="6" width="7" align="right"><img src="images/gridbox/grid_r_bt.gif" width="7" height="6" /></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table></td>
              </tr>
              
            </table></td>
          </tr>
        </table>