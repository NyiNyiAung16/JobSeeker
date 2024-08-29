<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $aboutus = "<h5><strong>About Us</strong></h5><p>Welcome to Job Seeker, where opportunities meet talent. We understand that finding the right job can be a daunting task, and our mission is to make this process as seamless and efficient as possible. Whether you're a seasoned professional looking for your next career move or a fresh graduate stepping into the job market for the first time, we're here to help you every step of the way.</p><p></p><p>At Job Seeker, we believe that every job seeker deserves access to opportunities that align with their skills, passions, and goals. Our platform is designed to connect you with employers who value your unique talents and are committed to your growth.</p><p>Our team is dedicated to continuously improving our platform to ensure it meets the evolving needs of today's job seekers. We offer personalized job recommendations, insightful career advice, and a supportive community to help you navigate your career journey with confidence.</p><p></p><p>Thank you for choosing Job Seeker as your trusted partner in your job search. Together, let's build the career you've always dreamed of.</p>";

        $privacy = "<p><strong>Privacy Policy</strong></p><p>At Job Seeker, your privacy is of utmost importance to us. This Privacy Policy outlines how we collect, use, disclose, and protect your personal information when you visit our website and use our services. By using [Your Website Name], you agree to the practices described in this policy.</p><h5>1. <strong>Information We Collect</strong></h5><p>We collect various types of information to provide and improve our services to you, including:</p><ul><li><p><strong>Personal Information:</strong> When you register on our website, apply for jobs, or interact with our services, we may collect personal details such as your name, email address, phone number, resume, and other information related to your job search.</p></li><li><p><strong>Usage Data:</strong> We may collect information on how you access and use our website, including your IP address, browser type, device information, and pages visited.</p></li></ul><h5>2. <strong>How We Use Your Information</strong></h5><p>We use the information we collect to:</p><ul><li><p>Facilitate your job search and connect you with potential employers.</p></li><li><p>Improve our website’s functionality and user experience.</p></li><li><p>Communicate with you regarding job opportunities, updates, and support.</p></li><li><p>Personalize your experience by showing relevant job recommendations and content.</p></li></ul><h5>3. <strong>Sharing Your Information</strong></h5><p>We respect your privacy and will not share your personal information with third parties, except in the following circumstances:</p><ul><li><p><strong>With Employers:</strong> We may share your information with employers when you apply for a job or when you make your profile visible to employers.</p></li><li><p><strong>Service Providers:</strong> We may share information with third-party service providers who assist us in operating our website and providing services to you.</p></li><li><p><strong>Legal Compliance:</strong> We may disclose your information if required by law or in response to valid requests by public authorities.</p></li></ul><h5>4. <strong>Security of Your Information</strong></h5><p>We take the security of your personal information seriously. We implement appropriate technical and organizational measures to protect your data from unauthorized access, alteration, disclosure, or destruction. However, please be aware that no method of transmission over the internet or electronic storage is completely secure.</p><h5>5. <strong>Your Rights</strong></h5><p>You have the right to access, update, or delete your personal information at any time. You can do this by logging into your account or contacting our support team. You also have the right to withdraw consent for us to process your data or to object to our use of your information.</p><h5>6. <strong>Cookies</strong></h5><p>We use cookies and similar tracking technologies to enhance your experience on our website. Cookies are small data files stored on your device that help us remember your preferences and track your usage. You can control the use of cookies through your browser settings.</p><h5>7. <strong>Changes to This Policy</strong></h5><p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal reasons. We will notify you of any significant changes by posting the updated policy on our website and updating the “Last Updated” date at the top of this page.</p><h5>8. <strong>Contact Us</strong></h5><p>If you have any questions or concerns about this Privacy Policy or our practices, please contact us at nyinyi@gmail.com.</p>";

        DB::table('contents')->insert([
            'type' => 'about_us',
            'body' => $aboutus
        ]);

        DB::table('contents')->insert([
            'type' => 'privacy',
            'body' => $privacy
        ]);

    }
}
