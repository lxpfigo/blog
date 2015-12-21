<?php
namespace App\Admin\Model;
use Framework\Model;
class CommentuserModel extends Model
{
	public function getCount()
	{
		$sql = 'select count(*) as count from web_commentuser';
		return $this->count($sql);
	}

	/*获取用户列表*/
	public function getUser($limit)
	{
		$sql = 'select * from web_commentuser ORDER BY join_time desc limit '.$limit[0].', '.$limit[1];
		return $this->findAll($sql);
	}

	/*删除用户*/
	public function delete($id)
	{
		$sql = 'delete from web_commentuser where `comment_user_id`='.$id;
		return $this->del($sql);
	}
}