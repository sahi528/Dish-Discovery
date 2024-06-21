<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Food Finder</title>
</head>
<body>
    <div class="container">
        <h1>Dish Discovery</h1>
        <form id="searchForm">
            <input type="text" id="find" placeholder="Enter ingredients">
            <button type="submit" class="btn">Find</button>
        </form>
        <div id="results" class="d-flex flex-nowrap overflow-auto"></div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                searchRecipes();
            });

            async function searchRecipes() {
                const searchValue = $('#find').val().trim();
                const response = await fetch(`https://api.edamam.com/search?q=${searchValue}&app_id=e50ac279&app_key=8bc5ef1b65eb797d79e5f7dfcefd0472&from=0&to=10`);
                const data = await response.json();
                displayRecipes(data.hits);
            }

            function displayRecipes(recipes) {
                let html = '';
                recipes.forEach((recipe) => {
                    html += `
                    <div>
                        <img src="${recipe.recipe.image}" alt="${recipe.recipe.label}">
                        <h3>${recipe.recipe.label}</h3>
                        <ul>
                            ${recipe.recipe.ingredientLines.map(ingredient => `<li>${ingredient}</li>`).join('')}
                        </ul>
                        <a href="${recipe.recipe.url}" target="_blank">View Recipe</a>
                    </div>
                    `;
                });
                $('#results').html(html);
            }
        });
    </script>
</body>
</html>
