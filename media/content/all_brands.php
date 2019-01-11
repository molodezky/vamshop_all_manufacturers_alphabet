<?php
   /* -----------------------------------------------------------------------------------------
   $Id: all_products.php, v 0.1.6 2005/05/15 $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project (earlier name of osCommerce)
   (c) 2002-2003 osCommerce (validproducts.php,v 0.01 2002/08/17); www.oscommerce.com

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------*/
?>

<?php
mb_internal_encoding("UTF-8");

	$q = "select distinct m.manufacturers_id id, m.manufacturers_name name from  " . TABLE_MANUFACTURERS . " m,  " . TABLE_PRODUCTS . " p WHERE m.manufacturers_id=p.manufacturers_id AND p.products_status ORDER BY m.manufacturers_name" ;

	$r = vam_db_query($q);

	$ms = array();
	while($row = vam_db_fetch_array($r)){
		$nm=trim($row['name']);
		$nm = ucfirst($nm);
		//$lett=preg_replace('@^(.).*@', '\1', $nm);
		$ms[mb_substr($nm,0,1)][]=$row;

		//$ms[$lett][]=$row;
	}

echo '<div class="row">';
	$c=0;
	if(is_array($ms))foreach ($ms as $k => $v) {

		echo '<div class="col-xs-12 col-sm-6">';
		echo "<h2>$k</h2>";
		if(is_array($v))foreach ($v as $k2 => $v2) {
			echo '<p><a href="index.php?manufacturers_id='.$v2['id'].'">'.$v2['name'].'</a></p>';
		}
		echo '</div>';

		$c++;
	}
echo '</div>';
?>
