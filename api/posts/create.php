<?php 

header('Access-Control-Allow-Origin: *'); // can access by anyone 
header('Content-Type: application/json'); // access by json 
header('Access-Control-Allow-Methods: POST');  
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');  

include_once '../../config/Database.php';
include_once '../../models/Posts.php';


// instantiate database and connect  

$database = new Database(); 
$db = $database->connect();

//instantiate blog post object 
$post = new Post($db);

// get raw posted dataa 
$data = json_decode(file_get_contents("php://input"));


$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// create post post
if ($post->create())
{
    echo json_encode
    (
        array('message' => 'Post Created')
    );
}
else 
{
    echo json_encode
    (
        array('message' => 'Post Not Created')
    );
}
?>