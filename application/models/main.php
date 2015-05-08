<?php
class Main extends CI_Model
{
	function get_cart()
	{
		return $this->db->query("SELECT * FROM products")->result_array();
	}

	function loadfrontproductsbyprice($num)
	{
		if ($num == 1)
		{
			$num = $num - 1;
		} else {
			$num = ($num - 1) * 9;
		}
		return $this->db->query("SELECT products.id, products.name, products.price, images.filename, images.product_id
								FROM products
								LEFT JOIN images
								ON products.id = images.product_id
                                WHERE products.display = 1
								GROUP BY name
                                LIMIT $num,9")->result_array();
	}
	function loadfrontproductscountall()
	{
		return $this->db->query("SELECT COUNT(*) FROM images LEFT JOIN products ON images.product_id = products.id WHERE main = 1 ORDER BY product_id ASC ")->result_array();
	}
	function loadtypeproductscount($typeid)
	{
		return $this->db->query("SELECT COUNT(*) 
					FROM products
					LEFT JOIN images
					ON products.id = images.product_id
					LEFT JOIN product_types
					ON products.id = product_types.product_id
					LEFT JOIN types
					ON product_types.type_id = types.id
					WHERE main = 1 AND types.id = ?",array($typeid))->result_array();
	}
	function loadfrontproductsbypopular()
	{
		return $this->db->query("SELECT products.id, products.name, products.price, images.filename, images.product_id
								FROM products
								LEFT JOIN images
								ON products.id = images.product_id
								GROUP BY name
								ORDER BY inventory_sold DESC")->result_array();
	}
	function loadfrontproductsbynewest()
	{
		return $this->db->query("SELECT products.id, products.name, products.price, products.inventory_count, images.filename, images.product_id
								FROM products
								LEFT JOIN images
								ON products.id = images.product_id
								GROUP BY name
								ORDER BY products.id DESC")->result_array();
	}
	function getproductbyid($id)
	{
		return $this->db->query("SELECT products.id, products.name, products.price, products.inventory_count, products.description
								FROM products
								WHERE products.id = ?",array($id))->result_array();
	}
	function getproductpicbyid($id)
	{
		return $this->db->query("SELECT * FROM images
								 WHERE product_id = ?",array($id))->result_array();
	}
	function getproductmainpic($id)
	{
		return $this->db->query("SELECT * FROM images
								WHERE images.product_id = $id
								AND main = 1 ")->result_array();
	} 
	function shipping($shipBill){
		$query = "INSERT INTO shippings (first_name, last_name, address, city, state, zipcode, created_at, updated_at) 
		VALUES (?,?,?,?,?,?, NOW(), NOW())";
		$values = array($shipBill['ship_firstname'], $shipBill['ship_lastname'], $shipBill['ship_address1'], $shipBill['ship_address2'], 
			$shipBill['ship_city'], $shipBill['ship_state'], $shipBill['ship_zipcode']);

		return $this->db->query($query, $values);
	}

	function billing($shipBill){
		$query = "INSERT INTO billings (first_name, last_name, address, city, state, zip,
		created_at, updated_at) VALUES (?,?,?,?,?,?,NOW(), NOW())";
		$values = array($shipBill['bill_firstname'], $shipBill['bill_lastname'], $shipBill['bill_address1'], 
			$shipBill['bill_city'], $shipBill['bill_state'], $shipBill['bill_zipcode']);
		return $this->db->query($query, $values);
	}
	function getalltypes()
	{
		return $this->db->query("SELECT * FROM types")->result_array();	
	}
	function getsimilarids($id)	
	{
		return $this->db->query("SELECT products.id, types.id as type_id, types.name
					FROM products
					LEFT JOIN images
					ON products.id = images.product_id
					LEFT JOIN product_types
					ON products.id = product_types.product_id
					LEFT JOIN types
					ON product_types.type_id = types.id
					WHERE images.main = 1 AND products.id = ?",array($id))->result_array();
	}
	function getsimilartypes($productid,$typeid)
	{
		return $this->db->query("SELECT products.id, products.name, products.price, images.filename,types.name
					FROM products
					LEFT JOIN images
					ON products.id = images.product_id
					LEFT JOIN product_types
					ON products.id = product_types.product_id
					LEFT JOIN types
					ON product_types.type_id = types.id
					WHERE images.main = 1 AND types.id = ? AND products.id != ?",array($typeid,$productid))->result_array();
	}
	function getshowtypes($typeid)
	{
		// if ($num == 1)
		// {
		// 	$num = $num - 1;
		// } else {
		// 	$num = ($num - 1) * 9;
		// }
		return $this->db->query("SELECT products.id, products.name, products.price, images.filename, images.product_id, types.name as 'type'
				FROM products
				LEFT JOIN images
				ON products.id = images.product_id
				LEFT JOIN product_types
				ON products.id = product_types.product_id
				LEFT JOIN types
				ON product_types.type_id = types.id
				WHERE images.main = 1 AND types.id = ?
				GROUP BY name
	            ORDER BY price
	            LIMIT 0,9",array($typeid))->result_array();
	}
}
?>