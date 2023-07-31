<?php

$url = $_SERVER['REQUEST_URI'];

if (strpos($url, '/') !== 0) {
    $url = '/' . $url;
}

if ($url == '/user' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $users = Auth::all();

    echo json_encode([
        'status' => 'success',
        'data' => $users,
    ]);
}

if ($url == '/user' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $user = new Auth($_POST);
    $userId = $user->save();
    if ($userId) {
        echo json_encode([
            'status' => 'success',
            'message' => 'new item inserted successfully',
            'href' => 'items/' . $userId,
        ]);
    } else {
        // $errors = $user->getValidationErrors();

        echo json_encode([
            'status' => 'failure',
            'message' => 'failed to insert new user',
            # 'errors' => $errors
        ]);
    }
}

if (preg_match('/user\/([0-9])+/', $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $matches[1];
    $user = Auth::find($userId);
    if ($user) {
        echo json_encode([
            'status' => 'success',
            'message' => 'your seached item found successfully',
            'data' => $user,
        ]);
    } else {
        echo json_encode([
            'status' => 'failure',
            'message' => 'your seached item not found',
        ]);
    }
}

if (preg_match('/user\/([0-9])+/', $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['_method'] == 'PUT') {
    // find item
    $userId = $matches[1];
    $user = Auth::find($userId);

    // update item
    $input = $_POST;
    $user->set_properties($input);

    if ($user->save()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'item updated successfully',
            'href' => 'items/' . $user->id,
        ]);
    } else {
        echo json_encode([
            'status' => 'failure',
            'message' => 'item couldn\'t update successfully',
        ]);
    }
}
