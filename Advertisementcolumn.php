<div class="adright_container">
    <script type="text/javascript" src="js/Searchlist.js"></script>
    <script type="text/javascript" src="adver/jquery.min.js"></script>
    <script type="text/javascript" src="js/popupbox.js" ></script>
    <script type="text/javascript" src="js/View.js" ></script>
        <link rel="stylesheet" href="adver/style.css" type="text/css" media="screen" />
        <script src="adver/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function () {
                    $(".newsticker-jcarousellite").jCarouselLite({
                        vertical: true,
                        hoverPause: true,
                        visible: 4,
                        auto: 5000,
                        speed: 300
                    });
                });
    </script>
    <div class="newsticker-jcarousellite" style="width:300px; height:500px;">
        <ul>

            <?php
            // $selectadquery = db_query("SELECT ADV_Id,ADV_Existornew,ADV_Selection,ADV_Name,ADV_Imagepath,ADV_Description,ADV_Selectionfk FROM ".TABLE_ADVERTISEMENT." where ADV_Status=1");
            $selectadquery = db_query("SELECT a.ADV_Id,a.ADV_Userfk,a.ADV_Existornew,a.ADV_Selection,a.ADV_Name,a.ADV_Imagepath,a.ADV_Description,a.ADV_Selectionfk,r.RGT_ProfileUrl FROM ".TABLE_ADVERTISEMENT." as a INNER JOIN `tbl_registration` as r ON r.RGT_PK=a.ADV_Userfk where ADV_Status=1");
            while(list($adv_id,$adv_userfk,$adv_existornew,$adv_selection,$adv_name,$adv_imagepath,$adv_description,$adv_selectionfk,$rgt_profilreurl) = db_fetch_array($selectadquery))
            {
            $adv_title   = $adv_name;
            $adv_userfk  =  $adv_userfk;
            $rgt_profilreurl = $rgt_profilreurl;
            if($adv_existornew==2)
            {
            $adv_imagepath   = $adv_imagepath;
            $adv_description = $adv_description;
            }
            else
            {
            if($adv_selection==1)
            {
            $selectadquery1 = db_query("SELECT PS_CoverImg,PS_Description FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$adv_selectionfk."'");
            list($ps_coverImg,$ps_description) = db_fetch_array($selectadquery1);
            $adv_imagepath   = $ps_coverImg;
            $adv_description = $ps_description;
            }
            else if($adv_selection==2)
            {
            $selectadquery2 = db_query("SELECT ET_Image,ET_Desp FROM ".TABLE_EVENTS." WHERE ET_Id='".$adv_selectionfk."'");
            list($et_image,$et_desp) = db_fetch_array($selectadquery2);
            $adv_imagepath   = $et_image;
            $adv_description = $et_desp;
            }
            else
            {
            $selectadquery3 = db_query("SELECT GY_Image,GY_Desp FROM ".TABLE_GALLERY." WHERE GY_Id='".$adv_selectionfk."'");
            list($gy_image,$gy_desp) = db_fetch_array($selectadquery3);
            $adv_imagepath   = $gy_image;
            $adv_description = $gy_desp;
            }        
            }
            ?>
            <li>
                <div style="cursor:pointer;">
                    <div class="right_singlead">
                        <div class="right_adtitle"> 
                            <a  <?php if ($_SESSION['LID'] != '') {?> href="<?php echo $rgt_profilreurl; ?>" target="_blank" 
                            <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $rgt_profilreurl; ?>','','');" 
                            <?php } ?> >   <?php echo $adv_title ;?>
                            </a>
                        </div>
                       <!--  <div style="width:290px;min-height:107px;"> -->
                        <div style="width:290px;min-height:107px;">
                            <div class="right_adimg">                     
                                <a  <?php if ($_SESSION['LID'] != '') {?> href="<?php echo $rgt_profilreurl; ?>"  target="_blank"
                                    <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $rgt_profilreurl; ?>','','');" 
                                    <?php } ?>> 
                                    <?php if($adv_imagepath !="") { ?>
                                        <img width="107" height="107" src="<?php echo $adv_imagepath;?>" style="border:solid 1px #999;"/>
                                    <?php } else { ?>
                                        <img width="107" height="107" src="images/no_image.png"/>
                                     <?php } ?>
                                </a>                       
                            </div>                                  
                            <div class="right_addesp">
                                <a  <?php if ($_SESSION['LID'] != '') {?> href="<?php echo $rgt_profilreurl; ?>" target="_blank" 
                                    <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $rgt_profilreurl; ?>','','');" 
                                    <?php } ?> >                           
                                  <span style="font-weight:bold;"><?php echo $adv_title ;?></span><br />
                                <?php 
                                $count=strlen($adv_description);
                                $displaydata=(substr($adv_description,0,80));
                                if($count>80){ 

                                 echo $displaydata.= '<a href="#"  style="font-weight:bold; color:#F90;text-decoration:none;" ><span> <br>View More.. </span></a>'; 
                                 
                                }
                                else {  echo $displaydata; }
                                ?> 
                                </a>                             
                            </div>
                        </div> 
                    </div>
                </div>
            </li>

            <?php } ?>
        </ul>
    </div> 
</div>





