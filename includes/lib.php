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

function getAllBooksByAuthorID($author_id)
{
	return selectByCondition("*","book","where  author_id like '$author_id'");
}


function getAllBooksByPublisherID($publisher_id)
{
	return selectByCondition("*","book","where  publisher_id like '$publisher_id'");
}


function getAllBooksByPubAndAuthAndSecByID($publisher_id,$author_id,$section_id)
{
	return selectByCondition("*","book","where  publisher_id And author_id And section_id like '$publisher_id','$author_id','$section_id' ");
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

//Author
function getAllAuthorWithBookTotals($author_id = null)
{
    if(isset( $author_id) && !empty($author_id))
    {
    return select(' SELECT a.* , COUNT(b.id) as total_book
                    FROM author AS a
                    LEFT JOIN book AS b ON a.id = b.author_id
                    WHERE a.id = '.$author_id.'
                    GROUP BY a.id;');
    }
    else
    {
    return select(' SELECT a.* , COUNT(b.id) as total_book
                    FROM author AS a
                    LEFT JOIN book AS b ON a.id = b.author_id
                    GROUP BY a.id;');
    }

}

//Book
function getAllBooksWithDetails($book_id = null)
{
    if(isset( $book_id) && !empty($book_id))
    {
    return select(' SELECT b.*, a.name as author_name , COUNT(b.id) as total_book
                    FROM book AS b
                    LEFT JOIN author AS a ON b.author_id = a.id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE b.id = '.$book_id.'
                    GROUP BY b.id;');
    }
    else
    {
    return select(' SELECT b.* , COUNT(id) as total_book
                    FROM book AS b
                    -- LEFT JOIN service AS s ON e.id = s.engineer_id
                    -- LEFT JOIN author AS a ON b.id = a.book_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY b.id;');
    }

}

function getAllBooksBySearch($search_term)
{
    return select(" SELECT book.*,
                           author.name AS author_name, 
                           publisher.name AS publisher_name, 
                           section.name AS section_name, 
                           language.name AS language_name,
                           13 AS available_copies_count
                    FROM book
                    JOIN author ON book.author_id = author.id
                    JOIN publisher ON book.publisher_id = publisher.id
                    JOIN section ON book.section_id = section.id
                    JOIN language ON book.language_id = language.id
                    WHERE CONCAT(book.id, book.name, book.number_copies, book.publish_date, book.detail) LIKE '%$search_term%'
                    OR author.name LIKE '%$search_term%'
                    OR publisher.name LIKE '%$search_term%'
                    OR section.name LIKE '%$search_term%'
                    OR language.name LIKE '%$search_term%';");
}

function getAllAuthorsBySearch($search_term)
{
    return select(" SELECT *
                    FROM author
                    WHERE CONCAT(id, name, email, phone, address, nationality) LIKE '%$search_term%'
                    ;");
}

function getAllPublishersBySearch($search_term)
{
    return select(" SELECT *
                    FROM publisher
                    WHERE CONCAT(id, name, email, phone, address) LIKE '%$search_term%'
                    ;");
}

function getAvailableBooksToIssue($book_id)
{
    return select("SELECT 13 AS available_copies_count;");
}
//Publisher

function getAllPublishersWithBookTotals($publisher_id = null)
{
    if(isset( $publisher_id) && !empty($publisher_id))
    {
    return select(' SELECT p.* , COUNT(b.id) as total_book
                    FROM publisher AS p
                    LEFT JOIN book AS b ON p.id = b.publisher_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    WHERE p.id = '.$publisher_id.'
                    GROUP BY p.id;');
    }
    else
    {
    return select(' SELECT p.* , COUNT(b.id) as total_book
                    FROM publisher AS p
                    LEFT JOIN book AS b ON p.id = b.publisher_id
                    -- LEFT JOIN rating AS r ON e.id = r.engineer_id
                    GROUP BY p.id;');
    }

}

//Section

function getAllSectionsWithBookTotals($section_id = null)
{
    if(isset( $section_id) && !empty($section_id))
    {
    return select(' SELECT s.* , COUNT(b.id) as total_book
                    FROM section AS s
                    LEFT JOIN book AS b ON s.id = b.section_id
                    -- LEFT JOIN book AS b ON s.id = b.section_id
                    WHERE s.id = '.$section_id.'
                    GROUP BY s.id;');
    }
    else
    {
        //,b.name as book_name
    return select(' SELECT s.* , COUNT(b.id) as total_book     
                    FROM section AS s
                    LEFT JOIN book AS b ON s.id = b.section_id
                    -- LEFT JOIN book AS b ON s.id = b.section_id
                    GROUP BY s.id;');
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