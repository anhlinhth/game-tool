<?php
class Zend_View_Helper_ItemType
{
	public function itemType($selected)
	{
		$arrData = array(
			array("id" => ITEM_TYPE_THUCPHAM, "name" => "Thực phẩm"),
			array("id" => ITEM_TYPE_NGOAICANH, "name" => "Ngoại cảnh"),
			array("id" => ITEM_TYPE_VATPHAMBOTRO, "name" => "Vật phẩm bổ trợ"),
			array("id" => ITEM_TYPE_NGOAITRANG, "name" => "Ngoại trang"),			
			array("id" => ITEM_TYPE_TINHLUYEN, "name" => "Vật phẩm tinh luyện"),
			array("id" => ITEM_TYPE_TRUNGTHU, "name" => "Vật phẩm trung thu (Sự kiện)"),
			array("id" => ITEM_TYPE_KIMINLENH, "name" => "Kim ỉn lệnh (Sự kiện)"),
			array("id" => ITEM_TYPE_TRIAN, "name" => "Vật phẩm tri ân (Sự kiện)"),
			array("id" => ITEM_TYPE_GIFT, "name" => "Gói phần thưởng, giảm giá")			
		);
		
		$strList .= "<select class='combobox2' name='type'/>";
		$strList .= "<option value='0'></option>";
		
		foreach($arrData as $data)
		{
			if($data['id'] == $selected)
				$strList .= "<option selected value='". $data['id'] ."'>". $data['name'] ."</option>";
			else
				$strList .= "<option value='". $data['id'] ."'>". $data['name'] ."</option>";
		}
		
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>