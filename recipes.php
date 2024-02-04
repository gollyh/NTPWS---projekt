<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your CSS styles here or link to an external stylesheet */
        .recipe-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Recipe Search</h1>

<!-- Search form -->
<form method="GET" action="index.php" link rel="stylesheet" href="style.css"> 
    <input type="hidden" name="menu" value="2"> <!-- Add a hidden field for menu parameter -->
    <label for="query">Type the name of the meal in lowercase:</label>
    <input type="text" id="query" name="query" required>
    <button type="submit">Search</button>
</form>

<?php

// Function to make the API request
function makeApiRequest($tags) {
    // Set the API endpoint URL
    $url = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/random?tags=$tags";

    // Set the headers
    $headers = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com',
                'X-RapidAPI-Key: b6d4849543mshfb368660a3910a2p1ce1b0jsn8cf927e63366'
            ],
        ],
    ];

    // Create the stream context
    $context = stream_context_create($headers);

    // Make the API request using file_get_contents
    $response = file_get_contents($url, false, $context);

    // Decode the JSON response
    return json_decode($response, true);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
    // Get the query from the form
    $tags = urlencode($_GET['query']);

    // Make the API request
    $recipes = makeApiRequest($tags);

    // Display the results
    displayRecipeResults($recipes['recipes']);
}

// Function to display recipe results
function displayRecipeResults($recipes)
{
    echo '<div id="recipeResults">';

    // Check if there are any recipes in the result
    if ($recipes && count($recipes) > 0) {
        foreach ($recipes as $recipe) {
            echo '<div class="recipe-card">';
            
            // Display the image
            if (!empty($recipe['image'])) {
                echo '<img src="' . htmlspecialchars($recipe['image']) . '" alt="Recipe Image" class="recipe-image">';
            }

            echo '<div class="recipe-title">Title: ' . htmlspecialchars($recipe['title']) . '</div>';
            
            // Remove HTML tags from the instructions
            $cleanInstructions = strip_tags($recipe['instructions']);
            echo '<div class="recipe-instructions">Instructions: ' . htmlspecialchars($cleanInstructions) . '</div>';
            
            echo '</div>';
        }
    } else {
        // Display a message if no recipes are found
        echo '<div class="no-results">No recipes found for in the search: ' . htmlspecialchars($_GET['query']) . '</div>';
    }

    echo '</div>';
}

?>
</body>
</html>
