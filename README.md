# traveling-salesman
Brute force PHP script for "Symmetric Traveling Salesman" problem.

Script takes points and outputs shortest route as an .svg image with route length in its name.

Coordinates can be negative and positive, this does not affect calculations. Grid size is calculated from point 0,0 to whatever is provided in $gridSize, negative values do not impact calculation. If you use negative values in grid size or point coordinates some viewers might have problems displaying this correctly, my suggestion is to keep everything in positive side.

Starting point will be the first point provided in the array.
Script will create folder where it will save .svg, if folder already exists it will put new file in that folder, if file with same name exists it will be overwritten.
Generated vector will have best route as a black line and starting point as green dot.

Check example.php for example.

P.s. Do not forget to dump-autoload before running the script.
