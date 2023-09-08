<?php include('header.html'); ?>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Add Customers Data</div>
        <div class="card-body">
            <form method="GET" autocomplete="on" action="">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control" required>
                        <option value="Airport West">Airport West</option>
                        <option value="Box Hill">Box Hill</option>
                        <option value="Yarravile">Yarravile</option>
                    </select>
                </div>
                <br>
                <button type="button" class="btn btn-primary" onclick="add_customer_get()" class="button">Add get</button>
                <button type="button" class="btn btn-primary" onclick="add_customer_post()" class="button">Add post</button><br><br>
            </form>
            <div id="add_response"></div>
        </div>
    </div>
</div>
<script src="ajax.js"></script>