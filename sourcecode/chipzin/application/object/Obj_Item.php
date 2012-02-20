<?php
class Obj_Item
{
	public $id;
	public $type;			//3,1 - groupitem, 4,2 - item,
	public $description;
	public $haveDefault;	//Có tác dụng với ngoại cảnh
	public $name;
	public $image;
	public $priceInGame;	//Giá bằng vàng
	public $priceOutGame;	//Giá bằng xu
	public $quantity;
	public $status;			//Không sử dụng
	public $currentStatus;	//Không sử dụng
	public $key;
	public $effect;
	public $level;			//Tới cấp bao nhiêu thì được mua
	public $limited;		//thời gian sử dụng (tính = giây) -1 là không giới hạn
	public $useAtHome;
	public $maxLevel;		//Giới hạn level có thể mua đồ: Ví dụ quá level 15 thì không được mua bắp
	public $exp;			//Kinh nghiệm khi mua đồ bằng xu
	public $refineLevel;	//Cấp tinh luyện (có tác dụng với thuốc tinh luyện)
	public $disCount;		//Giảm giá (hiển thị dưới client)
	public $expiredCoin;	//Số tiền gia hạn tăng thời gian sử dụng (bằng xu)
	public $enableInShop;	//Có hiện trong shop hay không
	public $effectProperties;	// Cấp của ngoại trang	
	public $order;			//Thứ tự trong shop	
}
?>
