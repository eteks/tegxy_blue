<?php $_REQUEST['user'] = (isset($_REQUEST['user']) ? $_REQUEST['user'] : ''); if(base64_decode($_REQUEST['user'])!='3'){?>
<div id="left_cate">
<?php /*?><h3 style="padding-left:28px"><a>Lobby</a></h3>
<?php */?><div id="navigation_vert">
<ul>
<li>
<a  class="navlink">Establishment Profile</a>
<div class="dropdown" id="dropdown_four">            

<p class="vertical"><a id="OpenProfile_1">Company Setup</a></p>
<?php if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<p class="vertical"><a id="OpenProfile_2">Owner Details</a></p>
<?php }?>
</div><!-- .dropdown_menu -->  
</li>
<?php if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<li>
<a  class="navlink">Content Management</a>
<div class="dropdown" id="dropdown_four"> 

<p class="vertical"><a id="OpenProfile_3" onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Grid','');">Profile</a></p>
<p class="vertical"><a id="OpenProfile_4">Activities</a></p>
</div><!-- .dropdown_menu -->   
</li>
<?php }?>
<li><a  class="navlink">Image Management</a>
<div class="dropdown" id="dropdown_four"> 

<p class="vertical"><a id="OpenProfile_5">Logo Upload</a></p>
<?php if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<p class="vertical"><a id="OpenProfile_6" onclick="GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Grid','');">Gallery</a></p>
<p class="vertical"><a id="OpenProfile_7" onclick="GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Grid','');">Header Settings</a></p>
<?php }?>
</div><!-- .dropdown_menu --> </li>

<!--<li><a  class="navlink">Email Settings</a>
<div class="dropdown" id="dropdown_four">            

<p class="vertical"><a id="OpenProfile_14">Email Reference</a></p>
<p class="vertical"><a id="OpenProfile_15">Reference History</a></p>
<p class="vertical"><a id="OpenProfile_16">Payment</a></p>

</div> 
</li>
<li><a  class="navlink">Communications</a>
<div class="dropdown" id="dropdown_four">            

<p class="vertical"><a id="OpenProfile_17">Email History</a></p>
<p class="vertical"><a id="OpenProfile_18">Chat</a></p>
<p class="vertical"><a id="OpenProfile_19">Visitors</a></p>

</div> 
</li>-->
<li><a  class="navlink" id="OpenProfile_8" onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Grid','');">Xbit</a>
</li>
<?php if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<li><a  class="navlink" id="OpenProfile_9" onclick="GridShowHide('ContactEntryLevel','ContactEntryGrid','Grid','');">Contact Info</a>
</li>
<?php } if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<li><a  class="navlink" id="OpenProfile_10" >Settings</a>
</li>
<li><a  class="navlink" id="OpenProfile_11" >Chat</a>
</li>
<?php }?>
</ul>
</div><!-- vertical_menu -->

<a><img src="images/correct_choice.jpg" width="120" height="100" border="no" /></a></div><?php }?>