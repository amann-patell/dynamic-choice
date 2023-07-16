<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Select</title>
</head>

<body>
    <h2>Select State:</h2>
    <select id="state">
        <option value="">Select State</option>
    </select>

    <h2>Select District:</h2>
    <select id="district">
        <option value="">Select District</option>
    </select>

    <!-- Load jQuery library from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to load district data based on the selected state
        function loadDistrictsByState(state) {
            $.ajax({
                url: 'server.php', // The server-side script to handle AJAX requests
                type: 'POST',
                data: {
                    type: 'districtData',
                    state: state // Send the selected state ID to the server
                },
                success: function(data) {
                    // Update the content of the "district" select element with the received data
                    $("#district").html(data);
                },
                error: function() {
                    alert("Failed to load districts.");
                }
            });
        }

        // Populate the "state" select element when the page is loaded
        $(document).ready(function() {
            // Send an AJAX request to get initial state data from the server
            $.ajax({
                url: 'server.php',
                type: 'POST',
                data: {
                    type: ''
                }, // Request the initial states from the server
                success: function(data) {
                    // Update the content of the "state" select element with the received data
                    $("#state").append(data);

                    // *** MODIFICATION STARTS HERE ***
                    // Load initial districts based on the first state
                    var initialState = $("#state").val();
                    if (initialState != "") {
                        loadDistrictsByState(initialState);
                    }
                    // *** MODIFICATION ENDS HERE ***
                },
                error: function() {
                    alert("Failed to load states.");
                }
            });

            // Event listener for the "state" select element
            $("#state").on("change", function() {
                var selectedState = $(this).val();
                if (selectedState != "") {
                    // Load district data based on the selected state
                    loadDistrictsByState(selectedState);
                } else {
                    // Clear the "district" select element if no state is selected
                    $("#district").html('<option value="">Select District</option>');
                }
            });
        });
    </script>
</body>

</html>