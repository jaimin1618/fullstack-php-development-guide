<?php

$url = $_SERVER['REQUEST_URI'];

if (strpos($url, '/') !== 0) {
    $url = '/' . $url;
}

if ($url == '/items' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $items = Item::all();

    echo json_encode([
        'status' => 'success',
        'data' => $items,
    ]);
}

if ($url == '/items' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $item = new Item($_POST);
    $itemId = $item->save();
    if ($itemId) {
        echo json_encode([
            'status' => 'success',
            'message' => 'new item inserted successfully',
            'href' => 'items/' . $itemId,
        ]);
    } else {
        $errors = $item->getValidationErrors();

        echo json_encode([
            'status' => 'failure',
            'message' => 'failed to insert new item',
            'errors' => $errors,
        ]);
    }
}

if (preg_match('/items\/([0-9])+/', $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $itemId = $matches[1];
    $item = Item::find($itemId);
    if ($item) {
        echo json_encode([
            'status' => 'success',
            'message' => 'your seached item found successfully',
            'data' => $item,
        ]);
    } else {
        echo json_encode([
            'status' => 'failure',
            'message' => 'your seached item not found',
        ]);
    }
}

if (preg_match('/items\/([0-9])+/', $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['_method'] == 'PUT') {
    // find item
    $itemId = $matches[1];
    $item = Item::find($itemId);

    // update item
    $input = $_POST;
    $item->set_properties($input);

    if ($item->save()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'item updated successfully',
            'href' => 'items/' . $item->id,
        ]);
    } else {
        echo json_encode([
            'status' => 'failure',
            'message' => 'item couldn\'t update successfully',
        ]);
    }
}
