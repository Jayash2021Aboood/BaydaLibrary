<?php

include("config.php");
include('myFunctions.php');




// ====================================================
// ====================================================
// ====================  Genral Method ==============

function select($statment)
{
    global $mysqlilink;
    $query = $statment;
    $res = mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>"); 

	$list = [];
    while($row=mysqli_fetch_array($res,MYSQLI_BOTH))
    {
      $list[] = $row;
	} 

	 return $list;
}

function selectByCondition($columns ,$table, $where = "")
{   
    return select("select $columns from $table $where");
}

function selectById($columns ,$table, $id)
{   
    return selectByCondition($columns, $table, "where id = $id");
}

function selectAndOrder($statment ,$columns = "id" , $type = "asc")
{   
    return select("$statment order by $columns $type");
}




function insert($statment)
{
    global $mysqlilink;
    $query = $statment;
    return  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );

}

function query($statment)
{
    global $mysqlilink;
    $query = $statment;
    $result =  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );
	
	if($result == false)
		echo mysqli_error($mysqlilink);
	return $result;
}


// ====================================================
// ====================================================
// ====================  Login Method ==============


function loginAdmin($username, $password)
{
	return select("SELECT * FROM admin WHERE username LIKE '$username' AND password LIKE '$password'");
}

// ====================================================
// ====================================================
// ====================  Addtional Method ==============

// دالة لجلب الخدمات اعتماد على نوع الخدمة
function getAllServicesByTypeID($service_type_id)
{
	return selectByCondition("*","service","where  service_type_id like '$service_type_id'");
}

// دالة لجلب الخدمات اعتماد على نوع الخدمة
function getAllServicesByEngineerID($engineer_id)
{
	return selectByCondition("*","service","where  engineer_id like '$engineer_id'");
}

function getAllEngineersWithRatesAndServiceTotals($engineer_id = null)
{
    if(isset( $engineer_id) && !empty($engineer_id))
    {
    return select(' SELECT e.* , COUNT(s.id) as total_service, SUM(r.rate)/ COUNT(r.id) as total_rate
                    FROM engineer AS e
                    LEFT JOIN service AS s ON e.id = s.engineer_id
                    LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE e.id = '.$engineer_id.'
                    GROUP BY e.id;');
    }
    else
    {
    return select(' SELECT e.* , COUNT(s.id) as total_service, SUM(r.rate)/ COUNT(r.id) as total_rate
                    FROM engineer AS e
                    LEFT JOIN service AS s ON e.id = s.engineer_id
                    LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY e.id;');
    }

}

function getAllBookingsWithDetails($customer_id = null)
{
    if(isset( $customer_id) && !empty($customer_id))
    {
        return select(' SELECT b.* , s.name as service, CONCAT( e.first_name,\' \',e.last_name)  as engineer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN engineer AS e ON e.id = b.engineer_id
                        WHERE b.customer_id = '.$customer_id.'
                        ;');
    }
    else
    {
        return select(' SELECT b.* , s.name as service, CONCAT( e.first_name,\' \',e.last_name)  as engineer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN engineer AS e ON e.id = b.engineer_id;');
    }
}


function getAllBookingsWithDetailsByEngineer($engineer_id = null)
{
    if(isset( $engineer_id) && !empty($engineer_id))
    {
        return select(' SELECT b.* , s.name as service, CONCAT( c.first_name,\' \',c.last_name)  as customer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN customer AS c ON c.id = b.customer_id
                        WHERE b.engineer_id = '.$engineer_id.'
                        ;');
    }
    else
    {
        return select(' SELECT b.* , s.name as service, CONCAT( c.first_name,\' \',c.last_name)  as customer
                        FROM booking AS b
                        LEFT JOIN service AS s ON s.id = b.service_id
                        LEFT JOIN customer AS c ON c.id = b.customer_id;');
    }
}



function getAllBookingNote($booking_id)
{
    return select("SELECT * FROM booking_note WHERE booking_id = $booking_id;");
}

function isUserExist($email)
{
    $webusers =  select("SELECT COUNT(id) as total FROM webuser WHERE email = '$email';");
    $admins =  select("SELECT COUNT(id) as total FROM admin WHERE email = '$email';");
    $customers =  select("SELECT COUNT(id) as total FROM customer WHERE email = '$email';");
    $engineers =  select("SELECT COUNT(id) as total FROM engineer WHERE email = '$email';");

    if( $webusers[0]["total"] > 0  ||
        $admins[0]["total"] > 0 ||
        $customers[0]["total"] > 0 ||
        $engineers[0]["total"] > 0) 
    {
        return true;
    }
    else
    {
        return false;

    }


}
?>