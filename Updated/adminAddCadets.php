<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Login</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <center>
        <img src = "vmilogo.svg" id = "logo">
        <h1>E-Section Marcher</h1>
        <h2>Add Cadets</h2>
        
    <div class = "loginForm" border = "solid">
    <form class = "addCadet" method="post">

        <table class = "addCadetTable">
            <tr class="emailLog">
                <td><label>Cadet ID:</label></td>
                <td><input id = "id_number" name = "id_number" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">First Name: </label></td>
                <td><input id = "first_name" name = "first_name" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">Last Name: </label></td>
                <td><input id = "last_name" name = "last_name" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">Email: </label></td>
                <td><input id = "email" name = "email" type = "email" required></td>
            </tr>

            <tr>
                <td><label class = "emailLog">Password: </label></td>
                <td><input id = "password" name = "password" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">Class: </label></td>
             	<td>
                <select id="class" name="class" required>
			    <option value="2022">2022</option>
			    <option value="2023">2023</option>
			    <option selected value="2024">2024</option>
			    <option value="2025">2025</option>
			    <option value="2026">2026</option>
			    <option value="2027">2027</option>
			  	</select>
			  	</td>
            </tr>


            <tr>
                <td><label class = "emailLog">Rank: </label></td>
             	<td>
                <select id="rank" name="rank" required>
			    <option value="1CPT">1CPT</option>
			    <option value="CPT">CPT</option>
			    <option value="1LT">1LT</option>
			    <option value="2LT">2LT</option>
			    <option value="SGM">SGM</option>
			    <option value="CSGT">CSGT</option>
			    <option value="1SGT">1SGT</option>
			    <option value="OPS">OPS</option>
			    <option value="MSG">MSG</option>
			    <option value="SGT">SGT</option>
			    <option value="CCPL">CCPL</option>
			    <option value="CPL">CPL</option>
			    <option selected value="PVT">PVT</option>
			  	</select>
			  	</td>
            </tr>
            <tr>
                <td><label class = "emailLog">Rank: </label></td>
             	<td>
                <select id="major" name="major" required>
			    <option selected value="CIS">CIS</option>
			    <option value="BI">BI</option>
			    <option value="CH">CH</option>
			    <option value="PS">PS</option>
			    <option value="HI">HI</option>
			    <option value="PY">PY</option>
			    <option value="CE">CE</option>
			    <option value="ME">ME</option>
			    <option value="ERH">ERH</option>
			    <option value="EE">EE</option>
			    <option value="AM">AM</option>
			    <option value="EC">EC</option>
                <option value="IS">IS</option>
                <option value="ML">ML</option>
			  	</select>
			  	</td>
            </tr>
            <tr>
                <td align = "center" colspan="2" class = "submitLine"><input type = "submit" name = "submit" id = "submitBtn"></td>
            </tr>
            </tr>
        </table>
    </form>  
    </div>
    <footer class="six" style = "margin-top: 5.5%;">
        <center>
            <p>&copy; Capstone Team 6</p>
        </center>
    </footer>
</center>

</body>
</html>
