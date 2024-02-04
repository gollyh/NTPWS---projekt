<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $formData = array(
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'country' => $_POST['country'],
        'subject' => $_POST['subject']
    );

    // Convert form data to JSON format
    $jsonData = json_encode($formData, JSON_PRETTY_PRINT);

    // Define the path to the JSON file
    $jsonFilePath = 'contact.json'; // Change this to the desired file path

    // Save data to the JSON file
    if (file_put_contents($jsonFilePath, $jsonData)) {
        echo '<p style="text-align:center; padding: 10px; background-color: #d7d6d6;border-radius: 5px;">Data saved successfully!</p>';
    } else {
        echo '<p style="text-align:center; padding: 10px; background-color: #ff0000; color: #ffffff; border-radius: 5px;">Error saving data!</p>';
    }
}


print'
		<h1>Contact</h1>
		<div id="contact">
    <p>In case of any additional questions regarding restaurants, please leave your contact and we will get back to you as soon as possible!</p>
    <figure>
        <img src="s_kontakt.jpg" alt="Kontakt" title="Kontakt" width="60%" height="340" frameborder="0" style="border:0" allowfullscreen>
    </figure>
    <form action="" id="contact_form" name="contact_form" method="POST">
				<label for="fname">First Name *</label>
				<input type="text" id="fname" name="firstname" placeholder="Your name.." required>

				<label for="lname">Last Name *</label>
				<input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
				
				<label for="lname">Your E-mail *</label>
				<input type="email" id="email" name="email" placeholder="Your e-mail.." required>

				<label for="country">Country</label>
				<select id="country" name="country">
				  <option value="">Please select</option>
				  <option value="BE">Chile</option>
				  <option value="HR" selected>Croatia</option>
				  <option value="LU">Luxembourg</option>
				  <option value="HU">China</option>
                  <option value="HU">Belgium</option>
                  <option value="HU">Canada</option>
                  <option value="HU">Japan</option>
                  <option value="HU">New Zealand</option>
				</select>

				<label for="subject">Subject</label>
				<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

				<input type="submit" value="Submit">
			</form>
		</div>';

		?>