<?php 

header('Access-Control-Allow-Origin: *'); // can access by anyone 
header('Content-Type: application/json'); // access by json 

include_once '../../config/Database.php';
include_once '../../models/Posts.php';


// instantiate database and connect  

$database = new Database(); 
$db = $database->connect();

//instantiate blog post object 
$post = new Post($db);

// blog post query 
$result = $post->read();

// getting row count object 
$num = $result->rowCount(); 

if ($num > 0)
{
    $post_arr = array(); 
    $post_arr['data'] = array();
    
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

        $post_item = array
        (
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author, 
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        array_push($post_arr['data'], $post_item);

    }
    // turn array to json

    echo json_encode($post_arr);

}
else 
{
    echo json_encode();
    array('message' => 'no post');
}


?>