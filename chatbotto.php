<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .user-message {
            margin-bottom: 10px;
        }
        .bot-message {
            margin-bottom: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Food Ordering Chatbot</h2>
        <div class="chat-box" id="chat-box">
            <div class="bot-message">Hi! Welcome to our food ordering website. How can I assist you?</div>
        </div>
        <form method="post">
            <input type="text" name="userInput" id="userInput" placeholder="Type your message here...">
            <button type="submit">Send</button>
        </form>
    </div>

    <?php
    // Function to handle user input and generate responses
    function handleInput($input) {
        $response = "";
        
        // Convert input to lowercase for easier comparison
        $input = strtolower($input);
        
        // Check for specific commands
        if (strpos($input, 'hello') !== false) {
            $response = "Hi! Do you want to check our food recommendations?";
        } elseif (strpos($input, 'yes') !== false) {
            $response = "Sure! Here are some of our recommended items:\n";
            $response .= "1. Orange Juice - Rs. 170\n";
            $response .= "2. Chicken Sandwich - Rs. 250\n";
            $response .= "3. Veggie Pizza - Rs. 300\n";
            $response .= "4. Chocolate Brownie - Rs. 150\n";
        } elseif (strpos($input, 'no') !== false) {
            $response = "Okay, feel free to ask if you need any assistance!";
        } else {
            $response = "I'm sorry, I didn't understand that. Could you please repeat?";
        }
        
        return $response;
    }

    // Check if user input is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input from the form
        $userInput = $_POST["userInput"];

        // Handle the user input and generate a response
        $botResponse = handleInput($userInput);

        // Output the bot response
        echo '<div class="bot-message">' . $botResponse . '</div>';
    }
    ?>
</body>
</html>
