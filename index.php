<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State & District</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body>

    <!-- <input type="textbox" id="num1">
    <a href="javascript:void(0)" onclick="click_here()">Click Here</a>

    <script>
        function click_here() {
            var num1 = jQuery('#num1').val();
            jQuery.ajax({
                url: 'code.php',
                type: 'post',
                data: 'num=' + num1,
                success: function(result) {
                    alert(result);
                }
            })
        }
    </script> -->

    <form action="code.php" method="post">

        <select id="state">
            <option value="">Select State</option>
        </select>

        <br><br>

        <select id="district">
            <option value=""></option>
        </select>

    </form>

    <script>
        $(document).ready(function() {
            function loadData(type, category_id) {
                $.ajax({
                    url: 'code.php',
                    type: 'POST',
                    data: {
                        type: type,
                        id: category_id
                    },
                    success: function(data) {
                        if (type == "districtData") {

                            $("#district").html(data);

                        } else {

                            $("#state").append(data);
                        }
                    }
                });
            }
            loadData();

            $("#state").on("change", function() {

                var state = $("#state").val();

                if (state != "") {

                    loadData("districtData", state);
                } else {
                    $("#district").html("");
                }

            })
        });
    </script>

</body>

</html>