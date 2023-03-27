<?php
// ====================================================
// ====================================================
// ======================= Start Setting Part ===========

class Setting
{
	public $id;
	public $return_days;
	public $fine_amount;
	public $student_max_issue;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->return_days = $row[1];
			$this->fine_amount = $row[2];
			$this->student_max_issue = $row[3];
		}
	}

}

function getAllSettings()
{
	return selectAndOrder("select * from setting","id","desc");
}

function getSettingById($id)
{
	return selectById("*","setting", $id);
}

function getSettingByName($search)
{
	return select("SELECT * FROM setting WHERE name like '%$search%' and active = 1");
}

function addSetting( $return_days, $fine_amount, $student_max_issue)
{
    $sql = 
		"INSERT INTO setting VALUES(null,
$return_days,$fine_amount,$student_max_issue)";	return query($sql);
}

function updateSetting( $id, $return_days, $fine_amount, $student_max_issue)
{
    $sql = 
		"UPDATE setting SET 
		return_days = $return_days
,		fine_amount = $fine_amount
,		student_max_issue = $student_max_issue
		WHERE id = $id ";
    return query($sql);
}

function deleteSetting($id)
{   
     return query("DELETE FROM setting WHERE id = $id");
}
?>


