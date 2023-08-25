<?php
require_once('../connection/connect.php');
// search handler for a asset
// query search
if (isset($_POST['search_asset']) && !empty($_POST['search_asset'])) {
    $search =$_POST['search_asset'];
    // $query = "SELECT * FROM assets WHERE asset_name = :asset_search|| quantity = :asset_search||asset_image = :asset_search||category_id =:asset_search ORDER BY asset_id DESC"; 
    // $query = "SELECT * FROM assets WHERE asset_name=:search_asset || quantity=:search_asset || asset_image = :search_asset ||category_id =:search_asset ORDER BY asset_id DESC";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':search_asset', $search, PDO::PARAM_STR);
} else {
    $query = "SELECT * FROM assets ORDER BY asset_id DESC";
    $stmt = $conn->prepare($query);
}
















// addig assets


