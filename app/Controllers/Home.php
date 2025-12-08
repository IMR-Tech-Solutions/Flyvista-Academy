<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\FlyvistaModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new FlyvistaModel();
        $data = [];

        /* -----------------------------------------
     * META TAGS (For SEO & Social Sharing)
     * ----------------------------------------- */
        $data['meta'] = [
            'title'       => 'FlyVista – Aviation Training Institute', // Page title
            'description' => 'Join FlyVista to advance your aviation career with expert trainers, top-notch courses, and hands-on experience.', // Meta description
            'keywords'    => 'aviation training, pilot courses, aviation institute, flight school', // Meta keywords
            'canonical'   => base_url() // Current page canonical URL
        ];

        /* -----------------------------------------
     * HERO SECTION (Multiple Slides)
     * ----------------------------------------- */
        $hero = $model->getTableData('hero_section', [], 'id', 0);

        foreach ($hero as $h) {
            // Button links
            $links = explode(',', $h->button_link);
            $h->btn1 = trim($links[0] ?? '#');
            $h->btn2 = trim($links[1] ?? '#');

            // Button texts
            $texts = explode(',', $h->experience_text);
            $h->btn_text_1 = trim($texts[0] ?? 'Learn More');
            $h->btn_text_2 = trim($texts[1] ?? 'Contact Us');
        }

        $data['hero_slides'] = $hero;

        /* -----------------------------------------
     * ABOUT SECTION
     * ----------------------------------------- */
        $about = $model->getTableData('about_section', [], '', 1);
        if (!empty($about)) {
            $about = $about[0];

            $about->feature1_icon        = array_map('trim', explode(',', $about->feature1_icon));
            $about->feature1_title       = array_map('trim', explode(',', $about->feature1_title));
            $about->feature1_description = array_map('trim', explode(',', $about->feature1_description));
        }
        $data['about'] = $about;

        /* -----------------------------------------
     * COURSES SECTION
     * ----------------------------------------- */
        $courses = $model->getTableData('courses', ['status' => 1], 'id', 0);
        $data['courses'] = $courses;

        // First course for headings
        $firstCourse = $model->getTableData('courses', ['status' => 1], 'id', 1);
        $firstCourse = !empty($firstCourse) ? $firstCourse[0] : null;

        $data['course_heading']    = $firstCourse ? $firstCourse->heading : '';
        $data['course_subheading'] = $firstCourse ? $firstCourse->subheading : '';

        /* -----------------------------------------
     * ADMISSION PROCESS
     * ----------------------------------------- */
        $admissionHeading = $model->getTableData('admission_process', [], 'step_number', 1);
        $data['admission_heading'] = !empty($admissionHeading) ? $admissionHeading[0] : null;

        $steps = $model->getTableData('admission_process', ['status' => 1], 'step_number', 0);
        $data['admission_steps'] = $steps;

        /* -----------------------------------------
     * TESTIMONIAL SECTION
     * ----------------------------------------- */
        $testimonialHeading = $model->getTableData('testimonials', [], 'id', 1);
        $data['testimonial_heading'] = !empty($testimonialHeading) ? $testimonialHeading[0] : null;

        $testimonials = $model->getTableData('testimonials', [], 'id', 0);
        $data['testimonials'] = $testimonials;

        /* -----------------------------------------
     * CONTACT INFO
     * ----------------------------------------- */
        $contactInfo = $model->getTableData('contact_info', [], 'id', 1);
        $data['contact_info'] = !empty($contactInfo) ? $contactInfo[0] : null;

        /* -----------------------------------------
     * BLOG SECTION
     * ----------------------------------------- */
        $blogHeading = $model->getTableData('blog_posts', [], 'id', 1);
        $data['blog_heading'] = !empty($blogHeading) ? $blogHeading[0]->excerpt : '';

        $blogs = $model->getTableData('blog_posts');
        $data['blogs'] = $blogs;

        /* -----------------------------------------
     * MERGE GLOBAL HEADER DATA + PAGE DATA
     * ----------------------------------------- */
        return view('frontend/index', $this->data + $data);
    }

    /* -----------------------------------------
     * CONTACT FORM SUBMISSION
     * ----------------------------------------- */
    public function submitContact()
    {
        helper('mailer'); // load mailer helper

        $model = new FlyvistaModel();

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'subject'   => $this->request->getPost('subject'),
            'message'   => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $save = $model->insertData('contact_form', $data);

        if ($save) {

            // =========================
            // ADMIN EMAIL CONTENT
            // =========================
            $adminEmailContent = "
        <div style='font-family:Arial,sans-serif; color:#333; line-height:1.5;'>
            <div style='background:#E94D65; color:#fff; padding:20px; text-align:center; border-radius:8px 8px 0 0;'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div style='padding:20px; border:1px solid #E94D65; border-top:none; border-radius:0 0 8px 8px;'>
                <p><strong>Name:</strong> {$data['full_name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Phone:</strong> {$data['phone']}</p>
                <p><strong>Subject:</strong> {$data['subject']}</p>
                <p><strong>Message:</strong><br>{$data['message']}</p>
                <hr style='margin:20px 0; border:none; border-top:1px solid #E94D65;'>
                <p style='font-size:12px; color:#999;'>This email was generated automatically from FlyVista Website Contact Form.</p>
            </div>
        </div>
        ";

            // =========================
            // USER THANK YOU EMAIL
            // =========================
            $userEmailContent = "
        <div style='font-family:Arial,sans-serif; color:#333; line-height:1.5;'>
            <div style='background:linear-gradient(90deg,#20406C,#335B95); color:#fff; padding:20px; text-align:center; border-radius:8px 8px 0 0;'>
                <h2>Thank You for Contacting FlyVista!</h2>
            </div>
            <div style='padding:20px; border:1px solid #20406C; border-top:none; border-radius:0 0 8px 8px;'>
                <p>Hi <strong>{$data['full_name']}</strong>,</p>
                <p>Thank you for reaching out to us. We have received your message and our team will get back to you shortly.</p>
                <p><strong>Your Message:</strong><br>{$data['message']}</p>
                <p>Meanwhile, feel free to explore our <a href='" . base_url('/') . "' style='color:#E94D65; text-decoration:none;'>website</a> for more information.</p>
                <hr style='margin:20px 0; border:none; border-top:1px solid #20406C;'>
                <p style='font-size:12px; color:#999;'>FlyVista Aviation Training Institute | &copy; " . date('Y') . "</p>
            </div>
        </div>
        ";

            // =========================
            // SEND MAILS
            // =========================
            $adminEmail = "admin@flyvistaacademy.com";

            // Admin notification
            sendMail(
                $adminEmail,
                "New Contact Inquiry - FlyVista",
                $adminEmailContent,
                $data['email'], // reply-to user
                $data['full_name']
            );

            // User thank you email
            sendMail(
                $data['email'],
                "Thank You for Contacting FlyVista",
                $userEmailContent
            );

            return redirect()->to(base_url('/'))
                ->with('success', 'Message sent successfully! You will also receive a confirmation email.');
        } else {
            return redirect()->to(base_url('/'))
                ->with('error', 'Failed to send message.');
        }
    }

    /* -----------------------------------------
     * STATIC PAGES WITH MENU DATA
     * ----------------------------------------- */
    public function about()
    {
        $model = new FlyvistaModel();

        /* ---------------- ABOUT SECTION ---------------- */
        $about = $model->getTableData('about_section', [], '', 1);
        if (!empty($about)) {
            $about = $about[0];
            $about->feature1_icon        = array_map('trim', explode(',', $about->feature1_icon));
            $about->feature1_title       = array_map('trim', explode(',', $about->feature1_title));
            $about->feature1_description = array_map('trim', explode(',', $about->feature1_description));
        }

        /* ---------------- BREADCRUMB SECTION ---------------- */
        $breadcrumb = $model->getTableData('breadcrumb_sections', ['slug' => 'about'], '', 1);
        $breadcrumb = !empty($breadcrumb) ? $breadcrumb[0] : null;

        /* ---------------- MISSION & VISION ---------------- */
        $missionVision = $model->getTableData('missions_vision', [], '', 1);
        $missionVision = !empty($missionVision) ? $missionVision[0] : null;

        /* ---------------- WHY CHOOSE US ---------------- */
        $whyChoose = $model->getTableData('why_choose_us', [], 'id ASC');

        /* ---------------- COUNTER SECTION ---------------- */
        $counters = $model->getTableData('counters', [], 'id ASC');

        /* ---------------- LEADERSHIP TEAM ---------------- */
        $leaders = $model->getTableData(
            'leaders',
            [],                  // no where condition, get all
            'display_order ASC'  // order by display_order
        );

        /* ---------------- META TAGS ---------------- */
        $meta = [
            'title'       => 'About FlyVista – Aviation Training Institute',
            'description' => 'FlyVista Academy, headquartered in Pune, Maharashtra, is one of the fastest-growing and most reputable Air Hostess & Aviation Training Institutes. Established in 2023, we provide advanced infrastructure, certified trainers, and industry-aligned training modules to groom skilled aviation professionals.',
            'keywords'    => 'About FlyVista, aviation training, air hostess courses, pilot training, hospitality training, cabin crew, aviation academy',
            'canonical'   => base_url('about')
        ];

        $data = [
            'about'          => $about,
            'breadcrumb'     => $breadcrumb,
            'missionVision'  => $missionVision,
            'whyChoose'      => $whyChoose,
            'counters'       => $counters,
            'leaders'        => $leaders, // pass to view
            'meta'          => $meta
        ];

        return view('frontend/about', $this->data + $data);
    }

    public function courses()
    {
        $model = new FlyvistaModel();

        // Fetch all active courses
        $allCourses = $model->getTableData('courses', ['status' => 1]);

        // Take the first course for section title (subheading & heading)
        $sectionTitle = !empty($allCourses) ? $allCourses[0] : null;

        // Fetch all flagship programs (or the active one)
        $programs = $model->getTableData('flagship_program');
        $program = !empty($programs) ? $programs[0] : null;
        // Fetch all success stories
        $allStories = $model->getTableData('success_stories');

        // Set featured story (first one or a designated featured)
        $featuredStory = null;
        foreach ($allStories as $story) {
            if ($story->is_featured) {
                $featuredStory = $story;
                break;
            }
        }

        // If no featured story, pick the first one
        if (!$featuredStory && !empty($allStories)) {
            $featuredStory = $allStories[0];
        }

        // ---------------- BREADCRUMB SECTION ----------------
        $breadcrumb = $model->getTableData('breadcrumb_sections', ['slug' => 'courses'], '', 1);
        $breadcrumb = !empty($breadcrumb) ? $breadcrumb[0] : null;

        // ---------------- META TAGS ----------------
        $meta = [
            'title'       => 'Professional Aviation Courses – FlyVista Academy',
            'description' => 'Explore FlyVista Academy’s professional aviation training courses, including Complete Air Hostess Training, Airport Ground Handling, Hospitality Management, and Customer Service programs. Gain industry-ready skills and 100% placement assistance.',
            'keywords'    => 'Aviation courses, Air Hostess Training, Airport Ground Handling, Hospitality Management, Customer Service, FlyVista Academy',
            'canonical'   => base_url('courses')
        ];

        $pageData = [
            'courses' => $allCourses,
            'sectionTitle' => $sectionTitle,
            'allStories' => $allStories,
            'program' => $program,
            'featuredStory' => $featuredStory,
            'breadcrumb' => $breadcrumb,
            'meta'          => $meta
        ];

        return view('frontend/courses', $this->data + $pageData);
    }

    /* -----------------------------------------
     * COURSE DETAIL PAGE (DYNAMIC)
     * ----------------------------------------- */
    public function courseDetail($slug)
    {
        $model = new FlyvistaModel();

        // Fetch the course
        $courseData = $model->getTableData(
            'courses',
            ['slug' => $slug, 'status' => 1],
            'id',
            1
        );

        if (empty($courseData)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Course not found.");
        }

        $course = $courseData[0];

        // Fetch course details
        $details = $model->getTableData(
            'course_details',
            ['course_id' => $course->id],
            'id',
            1
        );

        if (!empty($details)) {
            $detail = $details[0];

            // Decode JSON fields
            $detail->skills            = json_decode($detail->skills, true);
            $detail->training_methods  = json_decode($detail->training_methods, true);
            $detail->program_details = json_decode($detail->program_details, true);
            $detail->eligibility       = json_decode($detail->eligibility, true);
        } else {
            $detail = null;
        }

        // ---------------- BREADCRUMB ----------------
        $breadcrumb = $model->getTableData('breadcrumb_sections', ['slug' => $slug], '', 1);
        $breadcrumb = !empty($breadcrumb) ? $breadcrumb[0] : null;

        // ---------------- META TAGS ----------------
        $meta = [
            'title'       => $course->meta_title ?? $course->title ?? 'FlyVista – Aviation Course',
            'description' => $course->meta_description ?? substr(strip_tags($course->short_description ?? ''), 0, 160),
            'keywords'    => $course->meta_keywords ?? $course->title ?? 'aviation training, air hostess, cabin crew, airport ground handling',
            'canonical'   => base_url('course/' . $course->slug)
        ];

        // Send data to view
        $pageData = [
            'course'  => $course,
            'detail'  => $detail,
            'courses' => $model->getTableData('courses', ['status' => 1]),
            'breadcrumb' => $breadcrumb,
            'meta'          => $meta
        ];

        return view('frontend/course-detail', $this->data + $pageData);
    }
    public function submitCourseApplication()
    {
        helper('mailer'); // Load mailer helper

        $validation = \Config\Services::validation();

        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'phone'     => 'required',
            'subject'   => 'required',
            'course'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => $validation->getErrors()
            ]);
        }

        $model = new FlyvistaModel();

        $data = [
            'full_name'    => $this->request->getPost('full_name'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'subject'      => $this->request->getPost('subject'),
            'course'       => $this->request->getPost('course'),
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        $save = $model->insertData('course_applications', $data);

        if ($save) {

            /** ADMIN EMAIL CONTENT **/
            $adminContent = "
            <div style='font-family: \"Segoe UI\", Arial, sans-serif; max-width:700px; margin:auto; padding:30px; border-radius:15px; background:#f9fafc; color:#1f2937;'>
                
                <!-- Header -->
                <div style='background:#E94D65; padding:20px; border-radius:12px 12px 0 0; text-align:center; color:#fff;'>
                    <h1 style='margin:0; font-size:24px; font-weight:bold;'>✈ New Course Application!</h1>
                    <p style='margin:5px 0 0; font-size:14px;'>FlyVista Admin Notification</p>
                </div>

                <!-- Body -->
                <div style='padding:25px; background:#fff; border-radius:0 0 12px 12px;'>
                    <p style='font-size:16px; color:#111827;'>Hello Admin,</p>
                    <p style='font-size:14px; color:#374151;'>You have received a new course application. Here are the details:</p>

                    <ul style='list-style:none; padding:0; margin:20px 0;'>
                        <li style='padding:10px; border-bottom:1px solid #e5e7eb;'>
                            <strong>Name:</strong> {$data['full_name']}
                        </li>
                        <li style='padding:10px; border-bottom:1px solid #e5e7eb;'>
                            <strong>Email:</strong> {$data['email']}
                        </li>
                        <li style='padding:10px; border-bottom:1px solid #e5e7eb;'>
                            <strong>Phone:</strong> {$data['phone']}
                        </li>
                        <li style='padding:10px; border-bottom:1px solid #e5e7eb;'>
                            <strong>Subject:</strong> {$data['subject']}
                        </li>
                        <li style='padding:10px; border-bottom:1px solid #e5e7eb;'>
                            <strong>Course:</strong> {$data['course']}
                        </li>
                        <li style='padding:10px;'>
                            <strong style='color:#E94D65;'>Submitted At:</strong> {$data['submitted_at']}
                        </li>
                    </ul>

                    <p style='font-size:14px; color:#6b7280;'>This is an automated notification from FlyVista.</p>
                </div>
            </div>
            ";

            /** USER THANK YOU EMAIL **/
            $userContent = "
            <div style='font-family: \"Segoe UI\", Arial, sans-serif; max-width:700px; margin:auto; border-radius:15px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.15);'>

                <!-- Header with gradient -->
                <div style='background:linear-gradient(90deg, #335B95, #142947); padding:30px; text-align:center; color:#fff;'>
                    <h1 style='margin:0; font-size:28px; font-weight:bold;'>🎉 Application Received!</h1>
                    <p style='margin:5px 0 0; font-size:16px; font-weight:500;'>FlyVista Aviation Training Institute</p>
                </div>

                <!-- Body -->
                <div style='background:#f3f4f6; padding:30px; color:#1f2937; line-height:1.7;'>
                    <p style='font-size:16px;'>Dear <strong>{$data['full_name']}</strong>,</p>
                    <p style='font-size:15px; color:#374151;'>Thank you for applying for the <strong style='color:#E94D65;'>{$data['course']}</strong> course.</p>

                    <div style='margin:20px 0; padding:20px; background:#fff; border-left:5px solid #20406C; border-radius:10px;'>
                        <h3 style='margin:0 0 10px; color:#20406C;'>📋 Your Application Details</h3>
                        <ul style='list-style:none; padding:0; margin:0; color:#374151; font-size:14px;'>
                            <li><strong>Name:</strong> {$data['full_name']}</li>
                            <li><strong>Email:</strong> {$data['email']}</li>
                            <li><strong>Phone:</strong> {$data['phone']}</li>
                            <li><strong>Subject:</strong> {$data['subject']}</li>
                            <li><strong>Course:</strong> {$data['course']}</li>
                        </ul>
                    </div>

                    <p style='font-size:15px; color:#374151;'>Our team will review your application and contact you shortly. Meanwhile, feel free to explore our website for more courses and information.</p>

                    <div style='text-align:center; margin-top:25px;'>
                        <a href='http://localhost:8080/' style='display:inline-block; background:#E94D65; color:#fff; text-decoration:none; padding:12px 30px; border-radius:50px; font-weight:bold;'>Visit Our Website</a>
                    </div>

                    <p style='margin-top:30px; font-size:13px; color:#6b7280; text-align:center;'>FlyVista Aviation Training Institute &copy; 2025. All rights reserved.</p>
                </div>
            </div>
            ";
            // Admin Email
            $adminEmail = "admin@flyvistaacademy.com";

            // Send mail to Admin
            sendMail(
                $adminEmail,
                "New Course Application - FlyVista",
                $adminContent,
                $data['email'],
                $data['full_name']
            );

            // Send thank you mail to User
            sendMail(
                $data['email'],
                "Application Received - FlyVista",
                $userContent,
                $adminEmail,
                "FlyVista Team"
            );

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Course application submitted successfully!'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Failed to submit application.'
            ]);
        }
    }

    public function admission()
    {
        $model = new FlyvistaModel();
        $data = [];

        /* Fetch Courses (Dynamic) */
        $courses = $model->getTableData('courses', ['status' => 1], 'id DESC', 0);
        $data['courses'] = $courses;

        /* Existing sections */
        $heading = $model->getTableData('admission_process', [], 'id', 1);
        $data['admission_heading'] = !empty($heading) ? $heading[0] : null;

        $steps = $model->getTableData('admission_process', ['status' => 1], 'step_number ASC', 0);
        $data['admission_steps'] = $steps;

        $docs = $model->getTableData('documents', [], 'sort_order ASC', 0);
        $data['mandatory_docs'] = array_filter($docs, fn($d) => $d->is_optional == 0);
        $data['optional_docs']  = array_filter($docs, fn($d) => $d->is_optional == 1);

        $faqs = $model->getTableData('faqs', ['status' => 1], 'id ASC', 0);
        $data['faqs'] = $faqs;

        $breadcrumb = $model->getTableData('breadcrumb_sections', ['slug' => 'admission'], '', 1);
        $data['breadcrumb'] = !empty($breadcrumb) ? $breadcrumb[0] : null;

        /* Meta tags */
        $data['meta'] = [
            'title' => 'Flyvista: Aviation Training Institute | World’s Leading Air Hostess Training Academy',
            'description' => 'Step into a world of aviation excellence with FlyVista Academy. We prepare students for successful careers in aviation and hospitality through professional training, simulation labs, grooming, and placement support.',
            'keywords' => 'Flyvista, Aviation Training, Air Hostess Training, Cabin Crew Courses, Airport Ground Handling, Hospitality Management, Customer Service, Aviation Academy India',
            'canonical' => base_url('admission')  // Adjust this function if using a different URL helper
        ];

        return view('frontend/admission', array_merge($this->data, $data));
    }

    public function saveAdmissionForm()
    {
        $db = \Config\Database::connect();

        // Fetch Course Name from ID
        $courseId = $this->request->getPost('course_id');
        $courseRow = $db->table('courses')->where('id', $courseId)->get()->getRow();
        $courseTitle = $courseRow ? $courseRow->title : 'Unknown Course';

        // Prepare Data for DB
        $data = [
            'full_name'    => $this->request->getPost('full_name'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'subject'      => $this->request->getPost('subject'),
            'course'       => $courseTitle,
            'submitted_at' => date('Y-m-d H:i:s'),
        ];

        // Insert into course_applications table
        $db->table('course_applications')->insert($data);

        /* -------------------------
 * SEND MAIL TO ADMIN
 * ------------------------- */
        $adminBody = "
<div style='font-family: Arial, sans-serif; background:#F4F5FA; padding:30px;'>
    <div style='max-width:600px; margin:auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.05);'>
        
        <!-- Header -->
        <div style='background:#20416C; padding:20px; text-align:center; color:white;'>
            <h1 style='margin:0; font-size:22px;'>New Admission Application</h1>
        </div>

        <!-- Body -->
        <div style='padding:25px; color:#333F4D; line-height:1.6;'>
            <p style='margin:0 0 10px;'>You have received a new admission application from the website.</p>
            <table style='width:100%; margin-top:15px; border-collapse:collapse;'>
                <tr>
                    <td style='padding:8px; font-weight:bold; width:35%;'>Full Name:</td>
                    <td style='padding:8px;'>{$data['full_name']}</td>
                </tr>
                <tr style='background:#F9FAFB;'>
                    <td style='padding:8px; font-weight:bold;'>Email:</td>
                    <td style='padding:8px;'>{$data['email']}</td>
                </tr>
                <tr>
                    <td style='padding:8px; font-weight:bold;'>Phone:</td>
                    <td style='padding:8px;'>{$data['phone']}</td>
                </tr>
                <tr style='background:#F9FAFB;'>
                    <td style='padding:8px; font-weight:bold;'>Course:</td>
                    <td style='padding:8px;'>{$data['course']}</td>
                </tr>
                <tr>
                    <td style='padding:8px; font-weight:bold;'>Subject:</td>
                    <td style='padding:8px;'>{$data['subject']}</td>
                </tr>
                <tr style='background:#F9FAFB;'>
                    <td style='padding:8px; font-weight:bold;'>Submitted At:</td>
                    <td style='padding:8px;'>{$data['submitted_at']}</td>
                </tr>
            </table>

            <p style='margin-top:20px; font-size:12px; color:#777;'>FlyVista Website – New Application Alert</p>
        </div>
    </div>
</div>
";

        sendMail(
            "admin@flyvistaacademy.com",
            "New Admission Application – " . $data["full_name"],
            $adminBody,
            $data['email'],
            $data['full_name']
        );

        /* -------------------------
 * SEND CONFIRMATION TO USER
 * ------------------------- */
        $userBody = "
<div style='font-family: Arial, sans-serif; background:#F4F5FA; padding:30px;'>
    <div style='max-width:600px; margin:auto; background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.05);'>
        
        <!-- Header -->
        <div style='background:#20416C; padding:20px; text-align:center; color:white;'>
            <h1 style='margin:0; font-size:22px;'>Application Received!</h1>
        </div>

        <!-- Body -->
        <div style='padding:25px; color:#333F4D; line-height:1.6;'>
            <p style='margin:0 0 10px;'>Hello <strong>{$data['full_name']}</strong>,</p>
            <p>Thank you for applying to <strong>FlyVista Aviation Academy</strong>. We have received your application successfully.</p>

            <div style='background:#eef7ff; border-left:4px solid #20416C; padding:15px; margin:15px 0; border-radius:6px;'>
                <p style='margin:0; font-size:16px; font-weight:bold; color:#20416C;'>Selected Course:</p>
                <p style='margin:5px 0 0; font-size:18px; font-weight:bold;'>{$data['course']}</p>
                <p style='margin:5px 0 0; font-size:14px;'>Subject: {$data['subject']}</p>
            </div>

            <p>Our admissions team will review your application and contact you shortly.</p>
            <p style='margin-top:20px; font-size:12px; color:#777;'>FlyVista Aviation Academy</p>
        </div>
    </div>
</div>
";

        sendMail(
            $data['email'],
            "FlyVista – Application Received",
            $userBody,
            "admin@flyvistaacademy.com",
            "FlyVista Admin"
        );

        return $this->response->setJSON(['status' => 'success']);
    }

    public function career()
    {
        $model = new FlyvistaModel();

        // Fetch breadcrumb for this page
        $breadcrumbData = $model->getTableData('breadcrumb_sections', ['slug' => 'careers'], '', 1);
        $breadcrumb = !empty($breadcrumbData) ? $breadcrumbData[0] : null;

        // Fetch career features (CARD 1 & CARD 2 data)
        $careerFeatures = $model->getTableData('career_features', ['status' => 1]);

        // Convert list_items new lines into array
        if (!empty($careerFeatures) && isset($careerFeatures[0]->list_items)) {
            $careerFeatures[0]->list_items = preg_split("/\r\n|\n|\r/", $careerFeatures[0]->list_items);
        }

        if (!empty($careerFeatures) && isset($careerFeatures[1]->list_items)) {
            $careerFeatures[1]->list_items = preg_split("/\r\n|\n|\r/", $careerFeatures[1]->list_items);
        }

        // Fetch Placement + Career main section
        $placementCareer = $model->getTableData('placement_career', ['status' => 1], '', 1);
        $placement = !empty($placementCareer) ? $placementCareer[0] : null;

        // Fetch active jobs
        $jobs = $model->getTableData('jobs', ['status' => 1]);

        // Extract unique categories
        $categories = [];
        foreach ($jobs as $job) {
            if (!in_array($job->category, $categories)) {
                $categories[] = $job->category;
            }
        }

        // Meta tags for SEO
        $meta = [
            'title'       => 'Careers at Flyvista Academy | Join Our Aviation Training Team',
            'description' => 'Explore exciting career opportunities at FlyVista Academy. Join a fast-growing aviation training brand, work with industry experts, and contribute to shaping future-ready aviation professionals.',
            'keywords'    => 'Flyvista Careers, Aviation Jobs, Cabin Crew Training Jobs, Aviation Training Careers, Flyvista Placement Team, Aviation Education Jobs, Careers in Aviation India',
            'canonical'   => base_url('career') // Update if your site uses a different URL helper
        ];

        // Final page data
        $pageData = [
            'breadcrumb'     => $breadcrumb,
            'careerFeatures' => $careerFeatures,
            'placement'      => $placement,
            'jobs'           => $jobs,
            'categories'     => $categories,
            'meta'           => $meta
        ];

        helper('date');

        return view('frontend/careers', $this->data + $pageData);
    }

    public function submitJobApplication()
    {
        helper('mailer');

        $validation = \Config\Services::validation();

        // Validation rules
        $rules = [
            'applicant_name'     => 'required',
            'applicant_email'    => 'required|valid_email',
            'applicant_phone'    => 'required',
            'applicant_position' => 'required',
            'resume'             => 'uploaded[resume]|max_size[resume,2048]|ext_in[resume,pdf,doc,docx]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Please fill all required fields correctly.'
            ]);
        }

        // Handle Resume Upload
        $file = $this->request->getFile('resume');
        $newName = $file->getRandomName();
        $file->move('assets/img/resumes', $newName);

        // Prepare Data
        $data = [
            'job_id'            => $this->request->getPost('job_id'),
            'applicant_name'    => $this->request->getPost('applicant_name'),
            'applicant_email'   => $this->request->getPost('applicant_email'),
            'applicant_phone'   => $this->request->getPost('applicant_phone'),
            'applicant_position' => $this->request->getPost('applicant_position'),
            'resume_path'       => $newName,
            'cover_letter'      => $this->request->getPost('cover_letter'),
            'submitted_at'      => date('Y-m-d H:i:s'),
        ];

        // Save into DB
        $model = new FlyvistaModel();
        $save  = $model->insertData('job_applications', $data);

        if ($save) {

            /* ---------- ADMIN EMAIL ---------- */
            $adminContent = "
<div style='font-family:\"Roboto Serif\",serif; max-width:700px; margin:auto; background:#FFFFFF; border-radius:16px; overflow:hidden; box-shadow:0 10px 25px rgba(15,23,42,0.08);'>
    <div style='background:linear-gradient(90deg,#253D6B 0%,#142947 100%); color:#F9FAFB; text-align:center; padding:35px 25px;'>
        <div style='background:#FFFFFF1A; border-radius:50px; padding:15px 30px; display:inline-block; margin-bottom:15px;'>
            <h2 style='margin:0; font-size:28px; font-weight:600;'>📝 New Job Application</h2>
        </div>
        <p style='margin:10px 0 0; opacity:0.9; font-size:16px;'>A new candidate has applied for a position</p>
    </div>
    
    <div style='padding:40px 35px; color:#16243E;'>
        <div style='background:#F4F5FA; border-radius:12px; padding:25px; margin-bottom:25px;'>
            <h3 style='margin:0 0 15px; color:#20416C; font-size:20px;'>Application Details</h3>
            <div style='display:grid; grid-template-columns:1fr 1fr; gap:15px;'>
                <div>
                    <p style='margin:8px 0;'><strong style='color:#20416C;'>Name:</strong><br>{$data['applicant_name']}</p>
                    <p style='margin:8px 0;'><strong style='color:#20416C;'>Email:</strong><br>{$data['applicant_email']}</p>
                </div>
                <div>
                    <p style='margin:8px 0;'><strong style='color:#20416C;'>Phone:</strong><br>{$data['applicant_phone']}</p>
                    <p style='margin:8px 0;'><strong style='color:#20416C;'>Position:</strong><br>{$data['applicant_position']}</p>
                </div>
            </div>
        </div>
        
        <div style='background:#F4F5FA; border-radius:12px; padding:25px;'>
            <h3 style='margin:0 0 15px; color:#20416C; font-size:20px;'>Application Documents</h3>
            <div style='display:flex; align-items:center; gap:15px;'>
                <div style='background:#D83030; color:white; padding:12px 20px; border-radius:8px; display:inline-flex; align-items:center; gap:8px; text-decoration:none;'>
                    <span>📄</span>
                    <a href='" . base_url('assets/img/resumes/' . $newName) . "' target='_blank' style='color:white; text-decoration:none; font-weight:500;'>Download Resume</a>
                </div>
            </div>
        </div>
        
        <div style='margin-top:30px; padding-top:25px; border-top:2px solid #F4F5FA; text-align:center;'>
            <p style='margin:0; color:#333F4D; font-size:14px;'>Please review this application in the admin panel</p>
        </div>
    </div>
</div>";

            sendMail(
                "admin@flyvistaacademy.com",
                "New Job Application - FlyVista",
                $adminContent,
                $data['applicant_email'],
                $data['applicant_name']
            );

            /* ---------- USER EMAIL ---------- */
            $userContent = "
<div style='font-family:\"Roboto Serif\",serif; max-width:700px; margin:auto; background:#FFFFFF; border-radius:16px; overflow:hidden; box-shadow:0 10px 25px rgba(15,23,42,0.08);'>
    <div style='background:linear-gradient(90deg,#253D6B 0%,#D83030 100%); color:#F9FAFB; text-align:center; padding:45px 25px; position:relative;'>
        <div style='background:#FFFFFF1A; border-radius:50px; padding:18px 35px; display:inline-block; margin-bottom:20px; backdrop-filter:blur(10px);'>
            <h2 style='margin:0; font-size:32px; font-weight:600;'>🎉 Application Received!</h2>
        </div>
        <p style='margin:15px 0 0; opacity:0.95; font-size:17px; font-weight:300;'>Thank you for choosing FlyVista</p>
    </div>
    
    <div style='padding:45px 35px; color:#16243E;'>
        <div style='text-align:center; margin-bottom:35px;'>
            <h3 style='margin:0 0 10px; color:#20416C; font-size:24px;'>Hello, {$data['applicant_name']}!</h3>
            <p style='margin:0; color:#333F4D; font-size:16px;'>We've received your application</p>
        </div>
        
        <div style='background:#F4F5FA; border-radius:12px; padding:30px; margin-bottom:30px; border-left:4px solid #20416C;'>
            <h4 style='margin:0 0 15px; color:#20416C; font-size:18px;'>Application Summary</h4>
            <p style='margin:0 0 10px;'><strong>Position Applied:</strong> {$data['applicant_position']}</p>
            <p style='margin:0;'><strong>Application Date:</strong> {$data['submitted_at']}</p>
        </div>
        
        <div style='background:linear-gradient(135deg,#F4F5FA,#FFFFFF); border:2px dashed #20416C33; border-radius:12px; padding:25px; text-align:center; margin-bottom:35px;'>
            <h4 style='margin:0 0 15px; color:#20416C; font-size:18px;'>What's Next?</h4>
            <p style='margin:0; color:#333F4D; line-height:1.6;'>Our HR team will carefully review your application and will contact you via email or phone within 3-5 business days.</p>
        </div>
        
        <div style='text-align:center; padding-top:25px; border-top:2px solid #F4F5FA;'>
            <p style='margin:0 0 20px; color:#333F4D; font-style:italic;'>Ready to take flight with your career</p>
            <div style='background:#20416C; color:white; padding:12px 30px; border-radius:8px; display:inline-block;'>
                <strong>FlyVista Careers Team</strong>
            </div>
            <p style='margin:20px 0 0; color:#666; font-size:14px;'>Elevating careers to new heights</p>
        </div>
    </div>
</div>";

            sendMail(
                $data['applicant_email'],
                "Your Application Has Been Received - FlyVista",
                $userContent,
                "admin@flyvistaacademy.com",
                "FlyVista Careers"
            );

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Application submitted successfully!'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to submit application.'
        ]);
    }

    public function blog()
    {
        $model = new FlyvistaModel();

        // Fetch all active blog posts
        $allPosts = $model->getTableData('blog_posts', 'post_date DESC');

        // Fetch breadcrumb section for Blog page
        $breadcrumbData = $model->getTableData('breadcrumb_sections', ['slug' => 'blog'], '', 1);
        $breadcrumb = !empty($breadcrumbData) ? $breadcrumbData[0] : null;

        // Meta tags for SEO
        $meta = [
            'title'       => 'Flyvista Academy Blog | Insights on Aviation Training & Careers',
            'description' => 'Read the latest updates, tips, and insights from FlyVista Academy’s aviation training experts. Explore career guidance, industry trends, and professional growth opportunities in aviation and hospitality.',
            'keywords'    => 'Flyvista Blog, Aviation Training Blog, Cabin Crew Tips, Airport Operations Insights, Aviation Career Guidance, Airline Training Updates, Aviation Education India',
            'canonical'   => base_url('blog') // Adjust if using a different URL helper
        ];

        $pageData = [
            'blogPosts'  => $allPosts,
            'breadcrumb' => $breadcrumb,
            'meta'       => $meta
        ];

        return view('frontend/blog', $this->data + $pageData);
    }

    public function blogDetail($slug)
    {
        $model = new FlyvistaModel();

        // Fetch Post
        $postData = $model->getTableData(
            'blog_posts',
            ['slug' => $slug],
            'id',
            1
        );

        if (!$postData) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Blog post not found.");
        }

        $post = $postData[0];

        // Fetch Blog Detail
        $detailData = $model->getTableData(
            'blog_detail',
            ['blog_post_id' => $post->id],
            'id',
            1
        );

        $detail = $detailData ? $detailData[0] : null;

        // Safely decode JSON (array or json string)
        function safeDecode($v)
        {
            if (empty($v)) return [];
            if (is_array($v)) return $v;
            return json_decode($v, true) ?? [];
        }

        // Fetch breadcrumb dynamically using slug pattern: 'blog/slug'
        $breadcrumbSlug = 'blog/' . $post->slug;
        $breadcrumbData = $model->getTableData('breadcrumb_sections', ['slug' => $breadcrumbSlug], '', 1);
        $breadcrumb = !empty($breadcrumbData) ? $breadcrumbData[0] : null;

        // Dynamic meta tags for the blog post
        $meta = [
            'title'       => $post->meta_title ?? $post->title ?? 'Flyvista Academy Blog',
            'description' => $post->meta_description ?? substr(strip_tags($detail->description ?? ''), 0, 160),
            'keywords'    => $post->meta_keywords ?? 'Flyvista Blog, Aviation Training, Cabin Crew, Airport Operations, Aviation Education',
            'canonical'   => base_url('blog/' . $post->slug)
        ];

        $pageData = [
            'post'          => $post,
            'detail'        => $detail,
            'aviation'      => safeDecode($detail->aviation_fact ?? []),
            'toc'           => safeDecode($detail->table_of_contents ?? []),
            'upcoming'      => safeDecode($detail->upcoming_courses ?? []),
            'specs'         => safeDecode($detail->simulator_specs ?? []),
            'description'   => $detail->description ?? '',
            'recentPosts'   => $model->getTableData('blog_posts', ['status' => 1], 'post_date DESC', 5),
            'breadcrumb'    => $breadcrumb,
            'meta'          => $meta
        ];

        return view('frontend/blog-detail', $this->data + $pageData);
    }

    protected $model;

    public function __construct()
    {
        $this->model = new FlyvistaModel();
    }

    public function contact()
    {
        helper(['form', 'mailer']);

        $model = new FlyvistaModel();
        $data = [];

        // Load static data
        $data['contact'] = $model->getTableData('contact_info', [], 'id', 1)[0] ?? null;
        $data['breadcrumb'] = $model->getTableData('breadcrumb_sections', ['slug' => 'contact'], '', 1)[0] ?? null;
        $data['courses_menu'] = $model->getTableData('courses', ['status' => 1], 'title ASC', 0);

        // Opening hours
        if (!empty($data['contact']->opening_hours)) {
            $lines = explode("\n", $data['contact']->opening_hours);
            foreach ($lines as $line) {
                $parts = explode(':', trim($line), 2);
                if (count($parts) === 2) {
                    $data['opening_hours'][] = [
                        'day'  => trim($parts[0]),
                        'time' => trim($parts[1])
                    ];
                }
            }
        } else {
            $data['opening_hours'] = [];
        }

        // Meta tags for SEO
        $data['meta'] = [
            'title'       => 'Contact Flyvista Academy | Get in Touch for Aviation Training',
            'description' => 'Reach out to FlyVista Academy for queries, admissions, or career guidance. Our team is ready to assist you with aviation courses, programs, and placement support.',
            'keywords'    => 'Flyvista Contact, Aviation Training Enquiry, Cabin Crew Courses Contact, Aviation Academy Pune, Flyvista Support, Aviation Education India',
            'canonical'   => base_url('contact') // Adjust if using a different URL helper
        ];

        return view('frontend/contact', $data);
    }


    public function saveContactForm()
    {
        $db = \Config\Database::connect();

        // Prepare DB Data (matching your form fields)
        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'course'     => $this->request->getPost('course'),
            'message'    => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Store in DB
        $db->table('contact_messages')->insert($data);

        /* ----------- SEND MAIL TO ADMIN ----------- */
        $adminBody = "
<div style='font-family:\"Roboto Serif\",serif; max-width:700px; margin:auto; background:#FFFFFF; border-radius:16px; overflow:hidden; box-shadow:0 10px 25px rgba(15,23,42,0.08);'>
    <div style='background:linear-gradient(90deg,#253D6B 0%,#142947 100%); color:#F9FAFB; text-align:center; padding:30px 25px;'>
        <div style='background:#FFFFFF1A; border-radius:50px; padding:12px 25px; display:inline-block; margin-bottom:10px;'>
            <h2 style='margin:0; font-size:24px; font-weight:600;'>📩 New Contact Message</h2>
        </div>
        <p style='margin:5px 0 0; opacity:0.9; font-size:14px;'>FlyVista Website – Contact Form Alert</p>
    </div>
    
    <div style='padding:35px 30px; color:#16243E;'>
        <div style='background:#F4F5FA; border-radius:12px; padding:25px; margin-bottom:20px;'>
            <h3 style='margin:0 0 20px; color:#20416C; font-size:20px; border-bottom:2px solid #20416C; padding-bottom:10px;'>Contact Details</h3>
            <div style='display:grid; grid-template-columns:1fr 1fr; gap:15px;'>
                <div>
                    <div style='margin-bottom:15px;'>
                        <strong style='color:#20416C; display:block; margin-bottom:5px;'>👤 Name</strong>
                        <span>{$data['name']}</span>
                    </div>
                    <div style='margin-bottom:15px;'>
                        <strong style='color:#20416C; display:block; margin-bottom:5px;'>📞 Phone</strong>
                        <span>{$data['phone']}</span>
                    </div>
                </div>
                <div>
                    <div style='margin-bottom:15px;'>
                        <strong style='color:#20416C; display:block; margin-bottom:5px;'>📧 Email</strong>
                        <span>{$data['email']}</span>
                    </div>
                    <div style='margin-bottom:15px;'>
                        <strong style='color:#20416C; display:block; margin-bottom:5px;'>🎓 Course</strong>
                        <span>{$data['course']}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div style='background:#F4F5FA; border-radius:12px; padding:25px; margin-bottom:25px;'>
            <h3 style='margin:0 0 15px; color:#20416C; font-size:20px;'>💬 Message Content</h3>
            <div style='background:white; padding:20px; border-radius:8px; border-left:4px solid #D83030;'>
                <p style='margin:0; line-height:1.6; color:#333F4D;'>{$data['message']}</p>
            </div>
        </div>
        
        <div style='background:#20416C; color:white; padding:15px 20px; border-radius:8px; text-align:center;'>
            <p style='margin:0; font-size:14px;'>
                <strong>Submitted At:</strong> {$data['created_at']} | 
                <strong>Reply To:</strong> {$data['email']}
            </p>
        </div>
    </div>
</div>";

        sendMail(
            "admin@flyvistaacademy.com",
            "New Contact Message – " . $data["name"],
            $adminBody,
            $data['email'],
            $data['name']
        );

        /* ----------- SEND CONFIRMATION TO USER ----------- */
        $userBody = "
<div style='font-family:\"Roboto Serif\",serif; max-width:700px; margin:auto; background:#FFFFFF; border-radius:16px; overflow:hidden; box-shadow:0 10px 25px rgba(15,23,42,0.08);'>
    <div style='background:linear-gradient(90deg,#253D6B 0%,#D83030 100%); color:#F9FAFB; text-align:center; padding:40px 25px;'>
        <div style='background:#FFFFFF1A; border-radius:50px; padding:15px 30px; display:inline-block; margin-bottom:15px; backdrop-filter:blur(10px);'>
            <h2 style='margin:0; font-size:28px; font-weight:600;'>✈️ Thank You for Contacting Us!</h2>
        </div>
        <p style='margin:10px 0 0; opacity:0.95; font-size:16px;'>FlyVista Aviation Academy</p>
    </div>
    
    <div style='padding:40px 35px; color:#16243E;'>
        <div style='text-align:center; margin-bottom:30px;'>
            <h3 style='margin:0 0 10px; color:#20416C; font-size:22px;'>Hello, {$data['name']}!</h3>
            <p style='margin:0; color:#333F4D;'>We appreciate you reaching out to us</p>
        </div>
        
        <div style='background:#F4F5FA; border-radius:12px; padding:25px; margin-bottom:25px; border-left:4px solid #20416C;'>
            <h4 style='margin:0 0 15px; color:#20416C; font-size:18px;'>📋 Your Inquiry Summary</h4>
            <div style='display:grid; grid-template-columns:1fr 1fr; gap:15px;'>
                <div>
                    <p style='margin:8px 0;'><strong>Course:</strong> {$data['course']}</p>
                </div>
                <div>
                    <p style='margin:8px 0;'><strong>Submitted:</strong> {$data['created_at']}</p>
                </div>
            </div>
        </div>
        
        <div style='background:linear-gradient(135deg,#F4F5FA,#FFFFFF); border:2px dashed #20416C33; border-radius:12px; padding:25px; margin-bottom:30px;'>
            <h4 style='margin:0 0 15px; color:#20416C; font-size:18px;'>💬 Your Message</h4>
            <div style='background:white; padding:20px; border-radius:8px; border:1px solid #E5E7EB;'>
                <p style='margin:0; line-height:1.6; color:#333F4D; font-style:italic;'>{$data['message']}</p>
            </div>
        </div>
        
        <div style='background:#F4F5FA; border-radius:12px; padding:25px; text-align:center;'>
            <h4 style='margin:0 0 15px; color:#20416C; font-size:18px;'>⏳ What Happens Next?</h4>
            <div style='display:grid; grid-template-columns:repeat(3,1fr); gap:15px; text-align:center;'>
                <div>
                    <div style='background:#20416C; color:white; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 10px; font-weight:bold;'>1</div>
                    <p style='margin:0; font-size:14px; color:#333F4D;'>Review Your Inquiry</p>
                </div>
                <div>
                    <div style='background:#20416C; color:white; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 10px; font-weight:bold;'>2</div>
                    <p style='margin:0; font-size:14px; color:#333F4D;'>Contact You</p>
                </div>
                <div>
                    <div style='background:#20416C; color:white; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 10px; font-weight:bold;'>3</div>
                    <p style='margin:0; font-size:14px; color:#333F4D;'>Provide Guidance</p>
                </div>
            </div>
        </div>
        
        <div style='text-align:center; padding-top:25px; border-top:2px solid #F4F5FA; margin-top:25px;'>
            <div style='background:#20416C; color:white; padding:12px 25px; border-radius:8px; display:inline-block; margin-bottom:15px;'>
                <strong>FlyVista Aviation Academy Team</strong>
            </div>
            <p style='margin:0; color:#666; font-size:14px;'>Your journey to the skies begins here!</p>
        </div>
    </div>
</div>";

        sendMail(
            $data['email'],
            "FlyVista – We Received Your Message",
            $userBody,
            "admin@flyvistaacademy.com",
            "FlyVista Support"
        );

        session()->setFlashdata('success', "Your message has been submitted successfully!");
        return redirect()->to(base_url('contact'));
    }


    public function terms()
    {
        $model = $this->model;

        // Fetch breadcrumb for Terms & Conditions page
        $breadcrumbData = $model->getTableData('breadcrumb_sections', ['slug' => 'terms'], '', 1);
        $breadcrumb = !empty($breadcrumbData) ? $breadcrumbData[0] : null;

        // Fetch all terms sections ordered by order_in_section
        $policies = $model->getTableData('terms', [], 'order_in_section ASC');

        // Get unique section names (for navigation)
        $sections = [];
        foreach ($policies as $policy) {
            if (!in_array($policy->section, $sections)) {
                $sections[] = $policy->section;
            }
        }

        // Meta tags for SEO
        $meta = [
            'title'       => 'Terms & Conditions | Flyvista Academy',
            'description' => 'Read the Terms & Conditions of FlyVista Academy. Learn about our policies, user guidelines, and rules for using our aviation training programs and website.',
            'keywords'    => 'Flyvista Terms, Aviation Training Policies, Cabin Crew Training Rules, Flyvista Academy Guidelines, Aviation Education Policies',
            'canonical'   => base_url('terms') // Adjust if your site uses a different URL helper
        ];

        $data = [
            'breadcrumb' => $breadcrumb,
            'policies' => $policies,
            'sections' => $sections,
            'meta' => $meta
        ];

        return view('frontend/terms', $this->data + $data);
    }

    public function privacy()
    {
        $model = $this->model;

        // Fetch breadcrumb for Privacy Policy page
        $breadcrumbData = $model->getTableData('breadcrumb_sections', ['slug' => 'privacy-policy'], '', 1);
        $breadcrumb = !empty($breadcrumbData) ? $breadcrumbData[0] : null;

        // Fetch all sections, ordered by 'order_in_section'
        $policies = $model->getTableData('privacy_policy', [], 'order_in_section ASC');

        // Get unique sections for quick nav
        $sections = [];
        foreach ($policies as $policy) {
            if (!in_array($policy->section, $sections)) {
                $sections[] = $policy->section;
            }
        }

        // Meta tags for SEO
        $meta = [
            'title'       => 'Privacy Policy | Flyvista Academy',
            'description' => 'Read the Privacy Policy of FlyVista Academy. Learn how we collect, use, and protect your personal information while accessing our aviation training programs and website.',
            'keywords'    => 'Flyvista Privacy Policy, Data Protection, Aviation Training Privacy, Cabin Crew Training Policies, Flyvista Academy Data Guidelines',
            'canonical'   => base_url('privacy-policy') // Adjust if your site uses a different URL helper
        ];

        $data = [
            'breadcrumb' => $breadcrumb,
            'policies' => $policies,
            'sections' => $sections,
            'meta' => $meta
        ];

        return view('frontend/privacy-policy', $this->data + $data);
    }

    public function reply()
    {
        $input = json_decode($this->request->getBody());
        $msg = strtolower($input->message);

        $responses = [

            "fees" => "Our course fees vary depending on the program. Airhostess training starts from ₹65,000. Would you like full details?",

            "admission" => "To get admission, you need to fill out the online application or visit our campus. Minimum qualification is 12th pass.",

            "courses" => "We offer Airhostess Training, Ground Staff, Cabin Crew, Customer Service & many more aviation programs.",

            "contact" => "You can contact us at +1 800 123 4567 or email us at info@flyvista.com.",

            "placement" => "Yes! FlyVista provides 100% placement assistance with top airlines & airports.",

            "hello" => "Hello! How can I assist you with FlyVista aviation courses?",
            "hi" => "Hi there! How can I help you today?",
            "hey" => "Hey! Ask me anything about aviation careers."
        ];

        $reply = "Sorry, I didn't understand that. Please ask about courses, fees, admission, or placements.";

        foreach ($responses as $key => $value) {
            if (strpos($msg, $key) !== false) {
                $reply = $value;
                break;
            }
        }

        return $this->response->setJSON(['reply' => $reply]);
    }
}
