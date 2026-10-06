<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection with jQuery and Radio Filter</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <form id="filterForm">
        <label>
            <input type="radio" name="gender" value="1" class="gender-radio" checked> Male
        </label>
        <label>
            <input type="radio" name="gender" value="2" class="gender-radio"> Female
        </label>
        <label>
            <input type="radio" name="gender" value="all" class="gender-radio"> All
        </label>
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function(){
            // Function to fetch data based on radio filter
            function fetchDataByGender(gender) {
                $.ajax({
                    type: 'GET',  // or 'POST' depending on your server-side script
                    url: '../website/fetch_data.php',  // replace with the actual path to your server-side script
                    dataType: 'json',
                    data: { gender: gender },
                    success: function(data){
                        // Display the fetched data
                        var card ="";
                        var objdata =JSON.stringify(data);
                        var objdataPase =JSON.parse(objdata);
                        objdataPase.forEach(element => {
                            var cardinside= `
                            <div class="p-3 border rounded">
                            ${element.tour_name}
                             </div>
                            `;
                            card +=cardinside;

                        });
                        $('#result').html(card);
                    },
                    error: function(xhr, status, error){
                        console.error('Error:', status, error);
                    }
                });
            }

            // Trigger the function on page load
            fetchDataByGender($('input[name="gender"]:checked').val());

            // Trigger the function on radio button change
            $('#filterForm input').change(function(){
                var selectedGender = $(this).val();
                fetchDataByGender(selectedGender);
            });
        });
    </script>

</body>
</html>
