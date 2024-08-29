<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyNames = [
            'Tech Innovators Inc.', 'Global Marketing Solutions', 'Creative Design Studio', 'Eco-Friendly Products', 'Healthcare Hub',
            'EduTech Ventures', 'Finance Solutions Ltd.', 'Retail World', 'Foodie Heaven', 'Fitness First',
            'Green Energy Solutions', 'Luxury Living Homes', 'Travel & Tours Co.', 'Auto Masters', 'Gaming Central',
            'Smart Home Tech', 'Event Planners Ltd.', 'Health & Wellness Inc.', 'Media Buzz', 'Construction Pro',
            'Digital Dreams', 'Fashion Forward', 'Pet Care Co.', 'Logistics Plus', 'Agriculture Advance',
            'Brew Masters', 'Cyber Security Experts', 'Consulting Partners', 'Software Solutions', 'Mobile Innovators'
        ];
        
        $positions = [
            'Software Engineer', 'Marketing Manager', 'Graphic Designer', 'Product Manager', 'Data Analyst',
            'Human Resources Manager', 'Sales Executive', 'Content Writer', 'Customer Service Representative', 'Financial Analyst',
            'Operations Manager', 'UX/UI Designer', 'Social Media Manager', 'Business Development Manager', 'Network Administrator',
            'Project Coordinator', 'Quality Assurance Specialist', 'Public Relations Officer', 'Event Coordinator', 'Office Administrator',
            'Research Scientist', 'Legal Advisor', 'Art Director', 'Maintenance Technician', 'Supply Chain Manager',
            'Restaurant Manager', 'IT Support Specialist', 'Consultant', 'Web Developer', 'Mobile App Developer'
        ];
        
        $locationNames = [
            'New York City, United States', 'Tokyo, Japan', 'London, United Kingdom', 'Paris, France', 'Sydney, Australia',
            'Berlin, Germany', 'Toronto, Canada', 'Mumbai, India', 'São Paulo, Brazil', 'Cairo, Egypt',
            'Beijing, China', 'Moscow, Russia', 'Johannesburg, South Africa', 'Dubai, United Arab Emirates', 'Mexico City, Mexico',
            'Buenos Aires, Argentina', 'Bangkok, Thailand', 'Istanbul, Turkey', 'Seoul, South Korea', 'Madrid, Spain',
            'Rome, Italy', 'Jakarta, Indonesia', 'Nairobi, Kenya', 'Lima, Peru', 'Los Angeles, United States',
            'Vancouver, Canada', 'Amsterdam, Netherlands', 'Warsaw, Poland', 'Athens, Greece', 'Singapore, Singapore'
        ];

        $categories = [
            'Accounting',
            'Administrative',
            'Advertising',
            'Agriculture',
            'Architecture',
            'Arts',
            'Banking',
            'Biotechnology',
            'Business',
            'Communications',
            'Construction',
            'Consulting',
            'Customer Service',
            'Design',
            'Education',
            'Engineering',
            'Entertainment',
            'Environmental',
            'Finance',
            'Healthcare',
            'Hospitality',
            'Human Resources',
            'Information Technology',
            'Logistics',
            'Manufacturing',
            'Pharmaceutical',
            'Public Relations',
            'Real Estate',
            'Retail',
            'Sales',
        ];
        
        $statuses = ['pending', 'approved', 'rejected'];
        
        function getRandomElement($array) {
            return $array[array_rand($array)];
        }

        function generateRandomDate($startDate, $endDate) {
            $timestamp = mt_rand(strtotime($startDate), strtotime($endDate));
            return date("Y-m-d H:i:s", $timestamp);
        }
        
        for ($i = 0; $i < 30; $i++) {
            $status = getRandomElement($statuses);
            $rejectionReason = $status === 'rejected' ? "Reason for rejection for {$positions[$i]}" : null;

            DB::table('_jobs_')->insert(
                [
                    'creator_id' => rand(1, 5),
                    'company_name' => $companyNames[$i],
                    'position' => $positions[$i],
                    'description' => "<p>We are seeking a <strong>{$positions[$i]}</strong> at <strong>{$companyNames[$i]}</strong>. This role involves <em>key responsibilities</em> such as:</p><ul><li>Responsibility 1 for {$positions[$i]}</li><li>Responsibility 2 for {$positions[$i]}</li><li>Responsibility 3 for {$positions[$i]}</li></ul>",
                    'image_url' => "/storage/images/company-".($i + 1).".jpg",
                    'location' => $locationNames[$i],
                    'job_type' => rand(0, 1) ? 'Full-time' : 'Part-time',
                    'category' => $categories[$i],
                    'close_date' => date('Y-m-d', strtotime("+".rand(10, 30)." days")),
                    'status' => getRandomElement($statuses),
                    'rejection_reason' =>  $rejectionReason,
                    'created_at' => generateRandomDate('-60 days', 'now')
                ]
            );
        } 
    }
}
