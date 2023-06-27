<?php

include('lib.php');

function AddNewIssue($book_id, $student_id) {
    try{
        // Check if setting is found
        $setting = GetSetting();
        if(is_null($setting) || count($setting) == 0){
            throw new Exception(lang("You shloud to do setting for library fisrt"));
        }
        $setting = $setting[0];

        // Check if book is available for issue
        if( CheckIfBookIsAvailableForIssue($book_id) == false){
            throw new Exception(lang("you can not issue this book its not available"));
        }

        // Check if student can issue
        if(CheckIfStudentCanIssue($student_id, $setting) == false ){
            throw new Exception(lang("this student can not make issue he should return previous books"));
        }

        // Assign issue date, return date, and fine amount per day from setting
        $issue_date = date('Y-m-d');
        $due_date = date('Y-m-d', strtotime($issue_date. $setting['return_days']. ' days'));
        $return_date = "NULL" ;
        $fine_per_day = $setting['fine_amount'];

        // Insert issue into database
        return addIssue($book_id, $student_id, $issue_date, $due_date, $return_date, $fine_per_day, 0);
        
    } catch (Exception $e) {
        // Handle error
        echo "Error: ". $e->getMessage();
    }
}


// function ReturnIssue($issue_id, $return_date = date('Y-m-d')) {
//     // Check if issue is closed
//     if (CheckIfIssueIsClosed($issue_id)) {
//         // Calculate fine days
//         $fine_days = CalculateFineDays($issue_id, $return_date);

//         // Add fine to database
//         if ($fine_days > 0) {
//             AddNewFine($issue_id, $fine_days);
//         }

//         // Update issue in database
//         $sql = "UPDATE issue SET return_date = '$return_date' WHERE id = '$issue_id'";
//         mysqli_query($conn, $sql);
//     }
// }

// function CheckIfIssueIsClosed($issue_id) {
//     $sql = "SELECT return_date FROM issue WHERE id = '$issue_id'";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
//     if ($row['return_date']!= null) {
//         return true;
//     } else {
//         return false;
//     }
// }

// function CheckIfAllowUpdateClosedIssue($issue_id) {
//     if (CheckIfIssueIsClosed($issue_id)) {
//         return false;
//     } else {
//         return true;
//     }
// }

// function CheckIfIssueHasNotPaidFine($issue_id) {
//     $sql = "SELECT total_fine FROM issue WHERE id = '$issue_id'";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
//     if ($row['total_fine'] == 0) {
//         return true;
//     } else {
//         return false;
//     }
// }


function GetSetting() {
    // Code to check if setting is found
    try {
        return select("SELECT * From setting LIMIT 1;");
    } catch (Exception $e) {
        // Handle error
        echo "Error: ". $e->getMessage();
    }
}

function CheckIfBookIsAvailableForIssue($book_id) {
    // Code to check if book is available for issue
    try{
        return getAvailableBooksToIssue($book_id) > 0;
    } catch (Exception $e) {
    // Handle error
        echo "Error: ". $e->getMessage();
    }
}

function CheckIfStudentCanIssue($student_id, $setting) {
    // Code to check if student can issue
    try{
        return !(getStudentIssuesTimes($student_id) >= $setting['student_max_issue']);

    } catch (Exception $e) {
    // Handle error
        echo "Error: ". $e->getMessage();
    }
}

function CalculateFineDays($issue_id, $return_date) {
    // Code to calculate fine days
}

function AddNewFine($issue_id, $fine_days) {
    // Code to add fine to database
}


?>