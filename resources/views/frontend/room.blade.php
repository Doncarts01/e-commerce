<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room</title>
</head>
<body>

    <h1>Create a Room with Inventory</h1>

    <form action="http://localhost:8000/api/rooms" method="POST" id="roomForm">

        <label for="title">Room Title:</label><br>
        <input type="text" id="title" name="title" placeholder="Enter room title" required><br><br>

        <h3>Inventory</h3>

 
        <label for="inventoryName">Inventory Name:</label><br>
        <input type="text" id="inventoryName" name="inventoryName" placeholder="e.g., Chairs" required><br><br>

 
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" placeholder="e.g., 10" required><br><br>

        <label for="condition">Condition:</label><br>
        <input type="text" id="condition" name="condition" placeholder="e.g., New" required><br><br>


        <label for="image">Image URL:</label><br>
        <input type="url" id="image" name="image" placeholder="e.g., http://example.com/image.jpg" required><br><br>


        <button type="submit">Create Room</button>
    </form>


    <script>
        document.getElementById('roomForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const title = document.getElementById('title').value;
            const inventoryName = document.getElementById('inventoryName').value;
            const quantity = document.getElementById('quantity').value;
            const condition = document.getElementById('condition').value;
            const image = document.getElementById('image').value;

  
            const inventory = {
                name: inventoryName,
                quantity: quantity,
                condition: condition,
                image: image
            };


            const data = {
                title: title,
                inventory: JSON.stringify(inventory) 
            };


            fetch('http://localhost:8000/api/rooms', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                }
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>

</body>
</html>
