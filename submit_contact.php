<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $firstName = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
    $lastName = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $company = htmlspecialchars(strip_tags(trim($_POST['company'])));
    $industry = htmlspecialchars(strip_tags(trim($_POST['industry'])));
    $materials = htmlspecialchars(strip_tags(trim($_POST['materials'])));
    $density = htmlspecialchars(strip_tags(trim($_POST['density'])));
    $application = htmlspecialchars(strip_tags(trim($_POST['application'])));
    $timetable = htmlspecialchars(strip_tags(trim($_POST['timetable'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));
    $hearAboutUs = htmlspecialchars(strip_tags(trim($_POST['hear_about_us'])));
    $communicationMethod = htmlspecialchars(strip_tags(trim($_POST['communication_method'])));
    $contactConsent = isset($_POST['contact_consent']) ? "Yes" : "No";
    $techRepContact = isset($_POST['tech_rep_contact']) ? "Yes" : "No";

    // Product interest as array
    $productInterest = isset($_POST['product_interest']) ? implode(", ", $_POST['product_interest']) : "None selected";

    // Validate required fields
    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($company) && !empty($industry) && !empty($timetable) && !empty($communicationMethod)) {

        // Prepare email message
        $to = "office.santoshindustries@gmail.com";  // Email address where form data will be sent
        $subject = "New Contact Form Submission";
        $emailBody = "
        New contact form submission:

        First Name: $firstName
        Last Name: $lastName
        Email: $email
        Phone: $phone
        Company: $company
        Industry: $industry
        Materials Handled: $materials
        Bulk Density: $density
        Application Description: $application
        Product Interest: $productInterest
        Timetable: $timetable
        Message: $message
        How did you hear about us: $hearAboutUs
        Preferred Communication Method: $communicationMethod
        Consent to Contact: $contactConsent
        Request for Tech Rep Contact: $techRepContact
        ";

        // Set headers for email
        $headers = "From: $email" . "\r\n" .
                    "Reply-To: $email" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();

        // Send email
        if (mail($to, $subject, $emailBody, $headers)) {
            // Redirect to thank you page or show success message
            echo "Thank you! Your message has been sent.";
        } else {
            echo "Sorry, there was an issue sending your message. Please try again.";
        }
    } else {
        // If required fields are missing
        echo "Please fill in all required fields.";
    }
} else {
    // Redirect to the form if the request method is not POST
    header("Location: contact_form.html");
    exit();
}
?>
