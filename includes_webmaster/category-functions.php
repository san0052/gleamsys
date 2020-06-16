<?php

/*********************************************************
*                 CATEGORY FUNCTIONS 
*********************************************************/

/*
	Return the current category list which only shows
	the currently selected category and it's children.
	This function is made so it can also handle deep 
	category levels ( more than two levels )
*/
function formatCategories($categories, $parentId)
{
	global  $sabera,$cfg;
	// $navCat stores all children categories
	// of $parentId
	$navCat = array();
	
	// expand only the categories with the same parent id
	// all other remain compact
	$ids = array();
	foreach ($categories as $category) {
		if ($category['cat_parent_id'] == $parentId) {
			$navCat[] = $category;
		}
		
		// save the ids for later use
		$ids[$category['cat_id']] = $category;
	}	

	$tempParentId = $parentId;
	
	// keep looping until we found the 
	// category where the parent id is 0
	while ($tempParentId != 0) {
		$parent    = array($ids[$tempParentId]);
		$currentId = $parent[0]['cat_id'];

		// get all categories on the same level as the parent
		$tempParentId = $ids[$tempParentId]['cat_parent_id'];
		foreach ($categories as $category) {
		    // found one category on the same level as parent
			// put in $parent if it's not already in it
			if ($category['cat_parent_id'] == $tempParentId && !in_array($category, $parent)) {
				$parent[] = $category;
			}
		}
		
		// sort the category alphabetically
		array_multisort($parent);
	
		// merge parent and child
		$n = count($parent);
		$navCat2 = array();
		for ($i = 0; $i < $n; $i++) {
			$navCat2[] = $parent[$i];
			if ($parent[$i]['cat_id'] == $currentId) {
				$navCat2 = array_merge($navCat2, $navCat);
			}
		}
		
		$navCat = $navCat2;
	}


	return $navCat;
}

/*
	Get all top level categories
*/
function getCategoryList()
{
	global  $sabera,$cfg;
	$sql = "SELECT `cat_id`, `cat_name`, `cat_image`
	        FROM ".$cfg['DB_CATEGORY']."
			WHERE `cat_parent_id` = 0
			ORDER BY `cat_name`";
    $result = $sabera->sql_query($sql);
    
    $cat = array();
    while ($row = $sabera->sql_fetchrow($result)) {
		extract($row);
		
		if ($cat_image) {
			$cat_image = $cfg['base_url'] . 'categoryImage/' . $cat_image;
		} else {
			$cat_image = $cfg['base_url'] . 'categoryImage/no-image-small.png';
		}
		
		$cat[] = array('url'   => $_SERVER['PHP_SELF'] . '?c=' . $cat_id,
		               'image' => $cat_image,
					   'name'  => $cat_name);

    }
	
	return $cat;			
}

/*
	Fetch all children categories of $id. 
	Used for display categories
*/
/*function getChildCategories( $id, $recursive = true)
{
	global  $sabera,$cfg;
	$i=0;
	$categories = array();
	$sql = "SELECT * FROM ".$cfg['DB_CATEGORY']."WHERE `cat_parent_id` = ".$id." ";
	$result = $sabera->sql_query($sql);
	 while ($row = $sabera->sql_fetchrow($result)) {
        $categories[$i] = $row['cat_id'];
		$i++;
	}
	//print_r($categories);
	
	$n     = count($categories);
	/*$child = array();
	for ($i = 0; $i < $n; $i++) {
		$catId    = $categories[$i]['cat_id'];
		$parentId = $categories[$i]['cat_parent_id'];
		if ($parentId == $id) {
			$child[] = $catId;
			if ($recursive) {
				$child   = array_merge($child, getChildCategories($categories, $catId));
			}	
		}
	}
	//print_r($child);
	return $categories;
}*/



function parentId($catId)
{
	global  $sabera,$cfg;
	$sql_usr 	= "SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_id` = '".$catId."'";
	$res_usr 	= $sabera->sql_query($sql_usr);
	$row_usr	=	$sabera->sql_fetchrow($res_usr);
	$pId 	= 	$row_usr['cat_parent_id'];
	return $pId;
}

function buildCategoryOptions($catId = 0)
{
	global  $sabera,$cfg;
	$sql = "SELECT `cat_id`, `cat_parent_id`, `cat_name` FROM ".$cfg['DB_CATEGORY']." ORDER BY cat_parent_id";
	$result = $sabera->sql_query($sql);
	
	$categories = array();
	while($row = $sabera->sql_fetchrow($result)) {
		list($id, $parentId, $name) = $row;
		
		if ($parentId == 0) {
			// we create a new array for each top level categories
			$categories[$id] = array('name' => $name, 'children' => array());
		} else {
			// the child categories are put int the parent category's array
			$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
		}
	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$name     = $value['name'];
		$children = $value['children'];
		
		$list .= "<option value=\"$key\"";
		if ($key == $catId) {
			$list.= " selected";
		}
			
		$list .= ">$name</option>\r\n";

		foreach ($children as $child) {
			$list .= "<option value=\"{$child['id']}\"";
			if ($child['id'] == $catId) {
				$list.= " selected";
			}
			
			$list .= ">&nbsp;&nbsp;{$child['name']}</option>\r\n";
		}
	}
	
	return $list;
}

function recursive($pid)
{
	global  $sabera,$cfg;
	 
	$count=0;
	$n='&nbsp;';
	$space='';
	for($i=0;$i<=$count;$i++)
	$space.=$n.$space;
	
	$str='';
	$sqlrec="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE  `cat_parent_id` = ".$pid." AND `categoryStatus`='A'";
	$resrec=$sabera->sql_query($sqlrec);
	while($rowrec=$sabera->sql_fetchrow($resrec)){
	
	/*$sql1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_id` = ".$row['cat_id']."";
	$res1=$sabera->sql_query($sql1);
	while($row1=$sabera->sql_fetchrow($res1)){
	$count=recursive1($row1['cat_parent_id']);
	}*/
	
	$str.='<option value="'.$rowrec['cat_id'].'">'.$space.'&raquo;&nbsp;'.$rowrec['cat_name'].'</option>';
	
	$str.=recursive($rowrec['cat_id']);
	
	
	}
	$count++;
	$space=$space.$n;
	return $str;
}

?>