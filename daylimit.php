<?php
    require 'dbInfo.php';
    $q1= $db->exec(
                        "UPDATE funware_project SET f_div = 'N' WHERE DATEDIFF(funware_project.f_date_limit , CURDATE()) < -1;"
                    );
                    
                            
?>
