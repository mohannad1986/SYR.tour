<?php
function checkitem($select, $from, $value)
{
    // لازم اولا حول المتغير كون لغلوبال مشان احسن اوصلو من برا
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select=?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    // مدام الرو كاونت معناتا عنا القيمة موجودة  لاتضيفا عالداتا بيس
    return $count;
    // روح عصفحة الممبرز قسم الانسرت وشوفا 
}

function getplacebytype($cityID, $placetype)
{
    global $con;
    $stmt = $con->prepare("SELECT places.*,city.name AS city_name
                                    FROM places
                                    INNER JOIN city on city.city_id =places.city_id
                                    WHERE
                                    places.city_id =?
                                    AND 
                                    type =?
                                ");
    $stmt->execute(array($cityID, $placetype));
    $plsces = $stmt->fetchAll();
    return $plsces;
}
