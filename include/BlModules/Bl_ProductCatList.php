<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	
	$str1 = addslashes($_POST['data']);
	if($str1!=''){
	$ProRel = 'SELECT Category_fk,SubCategory_fk,ProductType_fk FROM '.TABLE_PRODUCTRELATIVITY.' a , '.TABLE_ADMINPRODUCT.' b  WHERE a.Product_fk=b.Id AND b.ProductName LIKE "%'.$str1.'%" AND b.Status=1 AND b.Verify=1 ';
	$result = db_query($ProRel) or die(db_error());
	
	$ProRel2 = 'SELECT ProductName FROM '.TABLE_ADMINPRODUCT.'  WHERE ProductName LIKE "%'.$str1.'%"  AND Status=1 AND Verify=1 ';
	$result2 = db_query($ProRel2) or die(db_error());
	
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($FetProRel  = db_fetch_array($result))
		{	
		
		$final = ProductCategory($FetProRel['Category_fk']).StringLeftArrow(ProductSubCategory($FetProRel['SubCategory_fk']),' >> ',4).StringLeftArrow(ProductType($FetProRel['ProductType_fk']),' >> ',4);
		$finalId = $FetProRel['Category_fk'].StringLeftArrow($FetProRel['SubCategory_fk'],' >> ',4).StringLeftArrow($FetProRel['ProductType_fk'],' >> ',4);
		echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.$finalId.'</a></li>';
		 }
		echo '</ul>';
		echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">Not satisfied with the Recommended Categories?<a class="ahighlight" style="cursor:pointer;" onclick="ChooseCategory(\'ProClear\',\'Bl_ProductCatList.php\',\'ProCategoryResponse\');">Choose your own category here</a></div>';
	}
	else if(db_num_rows($result2))
	echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">No Recommended Categories Found. <a class="ahighlight" style="cursor:pointer;" onclick="ChooseCategory(\'ProClear\',\'Bl_ProductCatList.php\',\'ProCategoryResponse\');">Choose your own category here</a></div>';
	else
		echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">No Recommended Categories Found. <a class="ahighlight" style="cursor:pointer;" onclick="ChooseCategory(\'ProClear\',\'Bl_ProductCatList.php\',\'ProCategoryResponse\');">Choose your own category here</a></div>';
	}
	else
	{?>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:5px;"> 
        <tr>
        <td>
        <select id="ProCategory" size="12"  name="ProCategory" onchange="OnclickCategory(this.value,'ProCategory','ProSubCategory','ProductType','Bl_GeneralProductFilter');">
			<?php $SelectProduct=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." Where Status=1 order by ProductCat_Name ASC");
            $ContProduct=db_num_rows($SelectProduct);
            while($FetchProduct=db_fetch_array($SelectProduct))
            { ?> 
                <option value="<?php echo $FetchProduct['ProductCat_Pk']; ?>"><?php echo $FetchProduct['ProductCat_Name']; ?></option><?php
            } ?>
        </select>
        </td>
        <td>&nbsp;</td>
        <td><span id="ShowProductSubCategory"><select id="ProSubCategory" size="12"  name="ProSubCategory"></select></span></td>
        <td>&nbsp;</td>
        <td><span id="ShowProductType"><select id="ProductType" size="12"  name="ProductType"></select></span></td>
        </tr>
        <tr><td colspan="5" height="20"></td></tr>
        <tr><td colspan="5"><input type="button" value="Ok" onclick="CloseCategory('ProCategoryResponse');" />&nbsp;&nbsp;<input type="button" value="Cancel" onclick="ClearCategory('ProCategoryList','ProCategoryResponse','ProCategoryListId');" /></td></tr>
        <tr><td colspan="5" height="20"></td></tr>
        </table>
	<?php }
?>	   
