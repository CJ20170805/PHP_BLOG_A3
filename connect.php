 <?php
     define('DB_DSN','mysql:host=localhost:3306;dbname=serverside;charset=utf8');
     define('DB_USER','serveruser');
     define('DB_PASS','gorgonzola7!');     
     
    //  PDO is PHP Data Objects
    //  mysqli <-- BAD. 
    //  PDO <-- GOOD.
     try {
         // Try creating new PDO connection to MySQL.
         $db = new PDO(DB_DSN, DB_USER, DB_PASS);
         //,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
     } catch (PDOException $e) {
         print "Error: " . $e->getMessage();
         die(); // Force execution to stop on errors.
         // When deploying to production you should handle this
         // situation more gracefully. ¯\_(ツ)_/¯
     }
     

    try {
         $q = $db->query("CREATE TABLE IF NOT EXISTS `serverside`.`post` (
             `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
             `title` VARCHAR(255) NOT NULL,
             `content` text NOT NULL,
             `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         )");
     }
     catch (PDOException $e) {
         print "Error: " . $e->getMessage();
         die();
     }

     
 ?>