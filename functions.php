<?php
include('db_connection.php');

function getAllBooks() {
    global $conn;
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function searchBooks($search_term) {
    global $conn;
    $sql = "SELECT * FROM books WHERE book_name LIKE '%$search_term%'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addBook($book_name, $publisher_name, $stock) {
    global $conn;
    $sql = "INSERT INTO books (book_name, publisher_name, stock) VALUES ('$book_name', '$publisher_name', $stock)";
    return $conn->query($sql);
}

function deleteBook($book_id) {
    global $conn;
    $sql = "DELETE FROM books WHERE id=$book_id";
    return $conn->query($sql);
}

function updateBook($book_id, $book_name, $publisher_name, $stock) {
    global $conn;
    $sql = "UPDATE books SET book_name='$book_name', publisher_name='$publisher_name', stock=$stock WHERE id=$book_id";
    return $conn->query($sql);
}
