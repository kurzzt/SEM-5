<!--File		: show_books.php
	Deskripsi	: menampilkan data buku
-->
<?php include('./header.php')?>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Show Books Data</div>
        <div class="card-body">
            <form method="GET" autocomplete="on">
            <div class="form-group">
	            <label for="book">Cari :</label>
	            <input type="text" class="form-control" id="book" name="book">
            </div>
            <div id="detail_books"></div>
            <button type="button" class="btn btn-primary" onclick="showBooks(book.value)" class="button">Search</button>
            </form>
        </div>
    </div>
</div>
<?php include('./footer.php')?>
<script src="ajax.js"></script>